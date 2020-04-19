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
                    return redirect(route('login' , ['redirect' => route('content.show' , ['type' => $content->type , 'content' => $content])]))->with([
                        'status' => 'error',
                        'message' => 'برای دسترسی باید ثبت نام کنید'
                    ]);
                }
                $user = auth()->user();
                if($user->level < $content->category->level) {
                    return back()->with([
                        'status' => 'error',
                        'message' => " مرحله شما باید ".  $content->category->level  ." یا بیشتر باشد "
                    ]); 
                }
                return view('pages.content', ['content' => $content, 'type' => $request->type, 'categories' => $categories]);
                break;
            case 'INTRODUCTION':
            case 'JANEBI':  
                return view('pages.content', ['content' => $content, 'type' => $request->type]);
            case 'PREREQUISITES':
                return view('pages.content', ['content' => $content, 'type' => $request->type, 'categories' => $categories]);
                break;
        }
    }
    public function search(Request $request)
    {
        return Content::search($request->all())->get();
    }

    public function categoryShow(Request $request , Category $category) 
    {
        $catContents = Content::where('category_id' , $category->id)->whereIn('type' , ['EVENT' , 'STEP'])->get();
        return view('pages.category' , ['catContents' => $catContents , 'category' => $category]);
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
        return redirect(route('content.show' , ['content' => $content , 'type' => $content->type]))->with([
            'status' => 'success',
            'message' => 'پاسخ شما ارسال شد . شما می توانید در پروفایل خود پاسخ ها را مشاهده کنید'
        ]);
    }
}
