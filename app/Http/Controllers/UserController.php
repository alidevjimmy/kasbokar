<?php

namespace App\Http\Controllers;

use App\Content;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function profile(Request $request , User $user)
    {
        $request->validate([
            'page' => 'required|in:myInformation,readedContent,myAnswers,myReplays'
        ]);
        $readedContents = [];
        if ($request->page == 'readedContent') {
            $contentIds = DB::table('user_content')->select('content_id')->where('user_id' , $user->id)->where('read' , true)->get();
            $ids = [];
            foreach ($contentIds as $ci) {
                $ids[] = $ci->content_id;
            }
            $readedContents =  Content::latest()->findMany($ids);
        }
        return view('pages.profile', ['user' => $user , 'page' => $request->page , 'readedContents' => $readedContents]);
    }

    public function userUpdate(Request $request , User $user)
    {
        $validatedDate = $request->validate([
            'fullName' => ['required', 'string', 'max:255'],
            'workStatus' => ['required', 'string']
        ]);
        $user->update($validatedDate);
        return redirect(route('profile' , ['user' => $user , 'page' => 'myInformation']))->with([
            'status' => 'success',
            'message' => 'اطلاعات با موفقیت ویرایش شد'
        ]);
    }
}
