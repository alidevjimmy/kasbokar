<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Category;
use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContentController extends Controller
{
    const TYPES = "EVENT,PREREQUISITES,STEP,INTRODUCTION,JANEBI";

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
                    return redirect(route('login', ['redirect' => route('content.show', ['type' => $content->type, 'content' => $content])]))->with([
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
                return view('pages.content', ['content' => $content, 'type' => $request->type, 'categories' => $categories, 'readed' => $readed]);
                break;
            case 'INTRODUCTION':
            case 'JANEBI':
                return view('pages.content', ['content' => $content, 'type' => $request->type , 'categories' => $categories,]);
            case 'PREREQUISITES':
                $readed = false;
                if (auth()->check()) {
                    $user = auth()->user();
                    $readed = DB::table('user_content')->where('user_id', $user->id)->where('content_id', $content->id)->where('read', true)->exists();
                }
                return view('pages.content', ['content' => $content, 'type' => $request->type, 'categories' => $categories, 'readed' => $readed]);
                break;
        }
    }
    public function search(Request $request)
    {
        return Content::search($request->all())->get();
    }

    public function categoryShow(Request $request, Category $category)
    {
        $catContents = Content::where('category_id', $category->id)->whereIn('type', ['EVENT', 'STEP'])->get();
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
}
