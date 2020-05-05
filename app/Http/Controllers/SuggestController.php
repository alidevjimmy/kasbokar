<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Content;
use Illuminate\Http\Request;

class SuggestController extends Controller
{
    public function store(Request $request , Content $content)
    {
        $validatedData = $request->validate([
            'description' => 'required',
        ]);
        $validatedData['user_id'] = auth()->user()->id;
        $content->suggests()->create($validatedData);
        return redirect(route('content.show' , ['type' => $content->type , 'content' => $content]))->with([
            'status' => 'success',
            'message' => 'کامنت ثبت شد'
        ]);
    }

    public function edit(Request $request , Comment $comment)
    {
        $user = auth()->user();
        if ($user->id != $comment->user_id) {
            abort(404);
        }
        $validatedData = $request->validate([
            'description' => 'required'
        ]);
        $comment->update($validatedData);
        $content = Content::findOrFail($comment->commentable_id);
        return redirect(route('user.resume' , ['page' => 'resume' , 'user' => $user]))->with([
            'status' => 'success',
            'message' => 'پیشنهاد ویرایش شد.'
        ]);
    }

    public function destroy(Suggest $suggest) {
        $user = auth()->user();
        if ($user->id != $suggest->user_id) {
            abort(404);
        }
        $suggest->delete();
        $content = Content::findOrFail($suggest->content_id);
        return redirect(route('user.resume' , ['page' => 'resume' , 'user' => $user]))->with([
            'status' => 'success',
            'message' => 'پیشنهاد حذف شد.'
        ]);
    }
}
