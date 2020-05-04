<?php

namespace App\Http\Controllers;

use App\Answer;
use App\Content;
use App\Expriece;
use App\Fav;
use App\Http\Middleware\RouteOwner;
use App\Replay;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profile(Request $request, User $user)
    {
        $request->validate([
            'page' => 'required|in:myInformation,readedContent,myAnswers,resume,contents'
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
                $contentCount = Content::where('user_id' , $user->id)->count();
                $favs = Fav::where('user_id' , $user->id)->latest()->get();
                $exs = Expriece::where('user_id' , $user->id)->isShow()->latest()->get();
                return view('pages.profile', ['user' => $user , 'page' => 'resume' , 'contentCount' => $contentCount , 'favs' => $favs , 'exs' => $exs]);
                break;
            case 'contents':
                $contents = Content::where('user_id' , $user->id)->latest()->get();
                return view('pages.profile', ['user' => $user , 'page' => 'contents' , 'contents' => $contents]);
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
        $contentCount = Content::where('user_id' , $user->id)->count();
        $favs = Fav::where('user_id' , $user->id)->latest()->get();
        $exs = Expriece::where('user_id' , $user->id)->isShow()->latest()->get();
        return view('pages.profile',  ['user' => $user , 'page' => 'resume' , 'contentCount' => $contentCount , 'favs' => $favs , 'exs' => $exs]);
    }

    public function editResume(Request $request , User $user)
    {
        $request->validate([
            'section' => 'required|in:name&about&avatar,username,expriences,favs'
        ]);
        if (auth()->user()->id != $user->id) {
            abort(404);
        }
        if ($request->section == 'expriences' || $request->section == 'favs') {
            $request->validate([
                'favorexid' => 'required'
            ]);
            if ($request->section == 'expriences') {
                $ex = Expriece::findOrFail($request->favorexid);
                return view('pages.profiles.edit' , ['section' => $request->section , 'user' => $user , 'ex' => $ex]);
            }
            $fav = Fav::findOrFail($request->favorexid);
            return view('pages.profiles.edit' , ['section' => $request->section , 'user' => $user , 'fav' => $fav]);
        }
        return view('pages.profiles.edit' , ['section' => $request->section , 'user' => $user]);
    }

    public function updateResume(Request $request , User $user)
    {
        if (auth()->user()->id != $user->id) {
            abort(404);
        }
        $request->validate([
            'section' => 'required|in:name&about&avatar,username,expriences,favs'
        ]);
        switch($request->section) {
            case 'username':
                $validatedData = $request->validate([
                    'username' => 'required|unique:users'
                ]);
                $user->update($validatedData);
                break;
            case 'favs':
                $validatedData = $request->validate([
                    'description' => 'required',
                    'fav' => 'required'
                ]);
                $fav = Fav::findOrFail($request->fav);
                $fav->update($validatedData);
                break;
            case 'name&about&avatar':
                $validatedData = $request->validate([
                    'fullName' => 'required',
                ]);
                $validatedData['avatar'] = $user->avatar;
                if($request->avatar){
                    $request->validate([
                        'avatar' => 'mimes:jpeg,png,jpg'
                    ]);
                    $avatar = $this->uploadMedia($request , 'avatar');
                    $validatedData['avatar'] = $avatar;
                }
                $validatedData['about'] = $request->about;
                $user->update($validatedData);
                break;
            case 'expriences':
                $validatedData = $request->validate([
                    'title' => 'required',
                    'description' => 'required',
                    'ex' => 'required'
                ]);
                $ex = Expriece::findOrFail($request->ex);
                $validatedData['media'] = $ex->media;
                if($request->media){
                    $request->validate([
                        'media' => 'mimes:pdf,png,jpeg,jpg,docx,doc|max:10000',
                    ]);
                    $media = $this->uploadMedia($request , 'media');
                    $validatedData['media'] = $media;
                }
                $validatedData['link'] = $request->link;
                $ex->update($validatedData);
                break;
        }
        return redirect(route('user.resume' , ['page' => 'resume' , 'user' => $user]))->with([
            'status' => 'success',
            'message' => 'ویرایش انجام شد.'
        ]);
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

    public function storeResume(Request $request , User $user)
    {
        $request->validate([
            'section' => 'required|in:expriences,favs'
        ]);
        if (auth()->user()->id != $user->id) {
            abort(404);
        }
        if ($request->section == 'expriences') {
            $validatedData = $request->validate([
                'title' => 'required',
                'description' => 'required',
            ]);
            $validatedData['media'] = null;
            if ($request->media) {
                $request->validate([
                    'media' => 'mimes:pdf,png,jpeg,jpg,docx,doc|max:10000',
                ]);
                $media = $this->uploadMedia($request , 'media');
                $validatedData['media'] = $media;
            }
            $validatedData['link'] = $request->link ? $request->link : null;
            $user->experiences()->create($validatedData);
            return redirect(route('user.resume' , ['page' => 'resume' , 'user' => $user]))->with([
                'status' => 'success',
                'message' => 'تجربه با موفقیت اضافه شد.'
            ]);
        }
        if ($request->section == 'favs') {
            $validatedData = $request->validate([
                'description' => 'required',
            ]);
            $user->favs()->create($validatedData);
            return redirect(route('user.resume' , ['page' => 'resume' , 'user' => $user]))->with([
                'status' => 'success',
                'message' => 'علاقه مندی با موفقیت اضافه شد.'
            ]);
        }
    }

    protected function uploadMedia($request, $fieldName)
    {
        $fileName = time() . '.' . $request->file($fieldName)->extension();
        $request->file($fieldName)->move(public_path('uploads/media'), $fileName);
        return '/uploads/media/' . $fileName;
    }
}
