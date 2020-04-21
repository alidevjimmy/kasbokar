<?php

namespace App\Http\Controllers\Admin;

use App\Answer;
use App\Content;
use App\Http\Controllers\Controller;
use App\Replay;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
                $answers = Answer::where('content_id' , $request->filter)->latest()->get();
            }else {
                $answers = Answer::latest()->get();
            }
            return view('admin.pages.answers.index' , ['answers' => $answers , 'type' => $request->type]);
        }
        if ($request->filter) {
            $replays = Replay::where('answer_id' , $request->filter)->latest()->get();
        }else {
            $replays = Replay::latest()->get();
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
        $replay = Replay::create($validatedData);
        if ($request->accepted)
        {
            $answer->update([
                'accepted' => true
            ]);
            $this->addToReaded($answer);
            $this->levelUp($answer);
        }
        return redirect(route('admin.replay.edit' , ['replay' => $replay->id]))->with([
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
            $this->addToReaded($answer);
            $this->levelUp($answer);
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

    protected function levelUp($answer)
    {
        $user = User::findOrFail($answer->user_id);
        $recentEvents = Content::where('type' , 'EVENT')->whereHas('category' ,function($q) use ($user) {
            $q->where('level', '<=' , $user->level);
        })->get();
        $ids = [];
        foreach($recentEvents as $rc)
        {
            $ids[] = $rc->_id;
        }
        $user_content = DB::connection('pgsql')->table('user_content')->where('user_id' , $user->id)->whereIn('content_id' , $ids)->get();
        if (count($user_content) == count($recentEvents)) {
            $user->update([
                'level' => $user->level + 1
            ]);
        }
    }
    protected function addToReaded($answer)
    {
        $user_content = DB::table('user_content')->where('user_id' , $answer->user_id)->where('content_id' , $answer->content_id)->first();
        if (!$user_content) {
            DB::table('user_content')->insert([
                'user_id' => $answer->user_id,
                'content_id' => $answer->content_id,
                'read' => true
            ]);
        }
    }
}
