<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Category;
use App\Comment;
use App\Content;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    const TYPES = "EVENT,PREREQUISITES,STEP,INTRODUCTION,JANEBI,content";

    public function show(Request $request, Content $content)
    {
        $request->validate([
            'type' => 'required|in:' . self::TYPES
        ]);
        $canSee = [
            'can' => true,
            'why' => '',
            'contents' => []
        ];
        $categories = Category::orderBy('level', 'asc')->get();
        $comments = Comment::where('commentable_id' , $content->id)->where('parent_id' , null)->get();
        switch ($request->type) {
            case 'EVENT':
            case 'STEP':
                $pre = Content::where('type', 'STEP')
                    ->orWhere('type', 'EVENT')
                    ->orWhere('type', 'PREREQUISITES')
                    ->where('level', (string) ((int) $content->level - 1))
                    ->first();
                $next = Content::where('type', 'STEP')
                    ->orWhere('type', 'EVENT')
                    ->orWhere('type', 'PREREQUISITES')
                    ->where('level', (string) ((int) $content->level + 1))
                    ->first();
                if (!auth()->check()) {
                    return redirect(route('login', ['redirect' => route('content.show', ['type' => $content->type, 'content' => $content,'comments' => $comments])]))->with([
                        'status' => 'error',
                        'message' => 'برای دسترسی باید ثبت نام کنید'
                    ]);
                }
                $user = auth()->user();
                $readed = DB::table('user_content')->where('user_id', $user->id)->where('content_id', $content->id)->where('read', true)->exists();
                if ($user->level < $content->category->level) {
                    return back()->with([
                        'status' => 'error',
                        'message' => " مرحله شما باید " .  $content->category->level  . " یا بیشتر باشد "
                    ]);
                }
                return view('pages.content', ['content' => $content,'comments' => $comments, 'type' => $request->type, 'categories' => $categories, 'readed' => $readed]);
                break;
            case 'INTRODUCTION':
            case 'JANEBI':
                return view('pages.content', ['content' => $content,'comments' => $comments, 'type' => $request->type , 'categories' => $categories]);
            case 'content':
                $user = User::findOrFail($content->user_id);
                return view('pages.content' , ['content' => $content,'comments' => $comments , 'type' => $request->type , 'categories' => $categories , 'user' => $user]);
            case 'PREREQUISITES':
                $readed = false;
                if (auth()->check()) {
                    $user = auth()->user();
                    $readed = DB::table('user_content')->where('user_id', $user->id)->where('content_id', $content->id)->where('read', true)->exists();
                }
                return view('pages.content', ['content' => $content,'comments' => $comments, 'type' => $request->type, 'categories' => $categories, 'readed' => $readed]);
                break;
        }
    }
    public function search(Request $request)
    {
        $contents = Content::search($request->all())->latest()->get();
        return view('pages.search' , ['contents' => $contents]);
    }

    public function categoryShow(Request $request, Category $category)
    {
        $catContents = Content::where('category_id', (string)$category->id)->whereIn('type', ['EVENT', 'STEP'])->get();
        return view('pages.category', ['catContents' => $catContents, 'category' => $category]);
    }

    public function saveAnswer(Request $request)
    {
        $validatedData = $request->validate([
            'content_id' => 'required',
            'answer' => 'required'
        ]);
        $content = Content::findOrFail($request->content_id);
        $validatedData['user_id'] = auth()->user()->id;
        Answer::create($validatedData);
        return redirect(route('content.show', ['content' => $content, 'type' => $content->type]))->with([
            'status' => 'success',
            'message' => 'پاسخ شما ارسال شد . شما می توانید در پروفایل خود پاسخ ها را مشاهده کنید'
        ]);
    }

    public function changeStatus(Request $request, Content $content)
    {
        if (!auth()->check()) {
            return redirect(route('content.show', ['content' => $content->id, 'type' => $content->type]))->with([
                'status' => 'error',
                'message' => 'برای تغییر وضعیت آگهی باید وارد شوید'
            ]);
        }
        $user = auth()->user();
        $user_contentExists = DB::table('user_content')->where('user_id', $user->id)->where('content_id', $content->id)->exists();
        if ($request->read) {
            if ($user_contentExists) {
                DB::table('user_content')
                    ->where('user_id', $user->id)
                    ->where('content_id', $content->id)
                    ->update([
                        'read' => true
                    ]);
            } else {
                DB::table('user_content')
                    ->insert([
                        'user_id' => $user->id,
                        'content_id' => $content->id,
                        'read' => true
                    ]);
            }

            return redirect(route('content.show', ['content' => $content->id, 'type' => $content->type]))->with([
                'status' => 'success',
                'message' => 'وضعیت محتوا به خوانده شد تغییر کرد'
            ]);
        }
        if ($user_contentExists) {
            DB::table('user_content')
                ->where('user_id', $user->id)
                ->where('content_id', $content->id)
                ->update([
                    'read' => false
                ]);
        } else {
            DB::table('user_content')
                ->insert([
                    'user_id' => $user->id,
                    'content_id' => $content->id,
                    'read' => false
                ]);
        }
        return redirect(route('content.show', ['content' => $content->id, 'type' => $content->type]))->with([
            'status' => 'success',
            'message' => 'وضعیت محتوا به خوانده نشده تغییر کرد'
        ]);
    }

    public function add()
    {
        return view('pages.addContent');
    }
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|in:content'
        ]);
        $user = auth()->user();
        $validatedData = $request->validate([
            'title' => 'required',
            'shortText' => 'required',
            'body' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg',
        ]);
        $type = 'content';
        $validatedData['user_id'] = $user->id;
        $image = $this->uploadImage($request, 'image');
        $validatedData['image'] = $image;
        $validatedData['type'] = $type;
        Content::create($validatedData);
        return redirect(route('profile', ['page' => 'contents' , 'user' => $user]))->with([
            'status' => 'success',
            'message' => 'محتوا اضافه شد'
        ]);
    }

    public function uploadImage($request, $fieldName)
    {
        $fileName = time() . '_' . $fieldName . '.' . $request->file($fieldName)->extension();
        $request->file($fieldName)->move(public_path('uploads/images'), $fileName);
        return '/uploads/images/' . $fileName;
    }

    public function edit(Content $content)
    {
        if ($content->type != 'content') {
            abort(404);
        }
        if (auth()->user()->id != $content->user_id) {
            abort(404);
        }
        return view('pages.editContent' , ['content' => $content]);
    }
    public function update(Content $content , Request $request)
    {
        if ($content->type != 'content') {
            abort(404);
        }
        if (auth()->user()->id != $content->user_id) {
            abort(404);
        }
        $user = auth()->user();
        $validatedData = $request->validate([
            'title' => 'required',
            'shortText' => 'required',
            'body' => 'required',
            'image' => 'mimes:jpg,png,jpeg',
        ]);
        $type = 'content';
        if ($request->image) {
            $image = $this->uploadImage($request, 'image');
            $validatedData['image'] = $image;
        }
        $validatedData['type'] = $type;
        $content->update($validatedData);
        return redirect(route('profile', ['page' => 'contents' , 'user' => $user]))->with([
            'status' => 'success',
            'message' => 'محتوا ویرایش شد'
        ]);
    }

    public function destroy(Content $content)
    {
        if ($content->type != 'content') {
            abort(404);
        }
        if (auth()->user()->id != $content->user_id) {
            abort(404);
        }
        $content->delete();
        return redirect(route('profile', ['page' => 'contents' , 'user' => auth()->user()]))->with([
            'status' => 'success',
            'message' => 'محتوا حذف شد'
        ]);
    }
}
