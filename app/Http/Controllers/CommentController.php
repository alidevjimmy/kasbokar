<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Content;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request , Content $content)
    {
        $validatedData = $request->validate([
            'body' => 'required',
        ]);
        if ($request->parent) {
            $validatedData['parent_id'] = $request->parent;
        }
        $validatedData['user_id'] = auth()->user()->id;
        $content->comments()->create($validatedData);
        return redirect(route('content.show' , ['type' => $content->type , 'content' => $content]))->with([
            'status' => 'success',
            'message' => 'پیشنهاد پست ثبت شد شما می توانید آنها را از پروفایل شخصی خود مدیریت کنید'
        ]);
    }

    public function edit(Request $request , Comment $comment)
    {
        $user = auth()->user();
        if ($user->id != $comment->user_id) {
            abort(404);
        }
        $validatedData = $request->validate([
            'body' => 'required'
        ]);
        $comment->update($validatedData);
        $content = Content::findOrFail($comment->commentable_id);
        return redirect(route('content.show' , ['type' => $content->type, 'content' => $content]))->with([
            'status' => 'success',
            'message' => 'کامنت ویرایش شد'
        ]);
    }

    public function destroy(Comment $comment) {
        $user = auth()->user();
        if ($user->id != $comment->user_id) {
            abort(404);
        }
        $comment->delete();
        $content = Content::findOrFail($comment->commentable_id);
        return redirect(route('content.show' , ['type' => $content->type, 'content' => $content]))->with([
            'status' => 'success',
            'message' => 'کامنت حذف شد'
        ]);
    }
}
