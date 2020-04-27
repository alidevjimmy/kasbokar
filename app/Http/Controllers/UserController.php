<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Content;
use App\Replay;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profile(Request $request, User $user)
    {
        $request->validate([
            'page' => 'required|in:myInformation,readedContent,myAnswers,resume'
        ]);
        if (auth()->user()->id != $user->id) {
            abort(404);
        }
        $readedContents = [];
        $myAnswers = [];
        switch ($request->page) {
            case 'myInformation':
                return view('pages.profile', ['user' => $user, 'page' => $request->page]);
                break;
            case 'readedContent':
                $contentIds = DB::table('user_content')->select('content_id')->where('user_id', $user->id)->where('read', true)->get();
                $ids = [];
                foreach ($contentIds as $ci) {
                    $ids[] = $ci->content_id;
                }
                $readedContents =  Content::latest()->findMany($ids);
                return view('pages.profile', ['user' => $user, 'page' => $request->page, 'readedContents' => $readedContents]);
                break;
            case 'myAnswers':
                $myAnswers = Content::whereHas('answers', function ($q) use ($user) {
                    $q->where('user_id', $user->id);
                })->with('answers')->get();
                return view('pages.profile', ['user' => $user, 'page' => $request->page, 'myAnswers' => $myAnswers]);
                break;
            case 'resume':
                return view('pages.profile', ['user' => $user, 'page' => $request->page]);
                break;
        }
    }

    public function userUpdate(Request $request, User $user)
    {
        $validatedDate = $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'workStatus' => ['required', 'string'],
        ]);
        if (auth()->user()->id != $user->id) {
            abort(404);
        }
        $user->update($validatedDate);
        return redirect(route('profile', ['user' => $user, 'page' => 'myInformation']))->with([
            'status' => 'success',
            'message' => 'اطلاعات با موفقیت ویرایش شد'
        ]);
    }

    public function userResume(User $user , Request $request)
    {
        $request->validate([
            'page' => 'required|in:resume'
        ]);
        return view('pages.profile',  ['user' => $user , 'page' => 'resume']);
    }

    public function editResume(Request $request , User $user)
    {
        $request->validate([
            'section' => 'required|in:name&about,avatar,username,expriences,favs'
        ]);
        if (auth()->user()->id != $user->id) {
            abort(404);
        }

    }

    public function createResume(Request $request , User $user)
    {
        $request->validate([
            'section' => 'required|in:expriences,favs'
        ]);
        if (auth()->user()->id != $user->id) {
            abort(404);
        }
        
        return view('pages.profiles.create' , ['user' => $user , 'section' => $request->section]);
    }
}
