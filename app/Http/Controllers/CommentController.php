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
        $validatedData['user_id'] = auth()->user()->id;
        $content->comments()->create($validatedData);
        return redirect(route('content.show' , ['type' => $content->type , 'content' => $content]))->with([
            'status' => 'error',
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
            'body' => 'required'
        ]);
        $comment->update($validatedData);
        $content = Content::findOrFail($comment->commentable_id);
        return redirect(route('content.show' , ['type' => $content->type, 'content' => $content]))->with([
            'status' => 'error',
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
            'status' => 'error',
            'message' => 'کامنت حذف شد'
        ]);
    }
}
