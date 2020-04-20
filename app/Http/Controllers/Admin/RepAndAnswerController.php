<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Http\Controllers\Controller;
use App\Replay;
use Illuminate\Http\Request;

class RepAndAnswerController extends Controller
{
    CONST TYPE = 'ANSWER,REPLAY';
    public function index(Request $request)
    {
        $request->validate([
            'type' => 'required|in:'.self::TYPE,
        ]);
        if ($request->type == 'ANSWER')
        {
            if ($request->filter) {
                $answers = Answer::where('content_id' , $request->filter)->get();
            }else {
                $answers = Answer::get();
            }
            return view('admin.pages.answers.index' , ['answers' => $answers , 'type' => $request->type]);
        }
        if ($request->filter) {
            $replays = Replay::where('answer_id' , $request->filter)->get();
        }else {
            $replays = Replay::get();
        }
        return view('admin.pages.answers.index' , ['answers' => $replays , 'type' => $request->type]);
    }

    public function edit(Answer $answer)
    {
        return view('admin.pages.answers.edit' , compact('answer'));
    }
    public function editReplay(Replay $replay)
    {
        return view('admin.pages.answers.editReplay' , compact('replay'));
    }

    public function update(Answer $answer , Request $request)
    {
        $validatedData = $request->validate([
            'replay' => 'required',
        ]);
        $validatedData['answer_id'] = $answer->id;
        Replay::create($validatedData);
        if ($request->accepted)
        {
            $answer->update([
                'accepted' => true
            ]);
        }
        return redirect(route('admin.answer.index' , ['type' => 'replay' , 'filter' => $answer->id]))->with([
            'status' => 'success',
            'message' => 'ریپلای ثبت شد'
        ]);
    }

    public function updateReplay(Request $request , Replay $replay)
    {
        $validatedData = $request->validate([
            'replay' => 'required',
        ]);
        $replay->update($validatedData);
        $answer = Answer::findOrFail($replay->answer_id);
        if ($request->accepted)
        {
            $answer->update([
                'accepted' => true
            ]);
        }
        else{
            $answer->update([
                'accepted' => false
            ]);
        }
        return back()->with([
            'status' => 'success',
            'message' => 'ریپلای ویرایش شد'
        ]);
    }

    public function destroy(Replay $replay)
    {
        Replay::destroy($replay->id);
        return back()->with([
            'status' => 'success',
            'message' => 'ریپلای پاک شد'
        ]);
    }
}
