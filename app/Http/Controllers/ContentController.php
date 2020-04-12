<?php

namespace App\Http\Controllers;

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
        switch ($request->type) {
            case 'EVENT':
            case 'STEP':
                if (!auth()->check()) {
                    return back()->with([
                        'status' => 'error',
                        'work' => 'login',
                        'message' => "برای دسترسی به این محتوا باید وارد شوید"
                    ]);
                } else {
                    $user = auth()->user();
                    if ($user->level < $content->level) {
                        return back()->with([
                            'status' => 'error',
                            'message' => "مرحله شما {$user->level} است ولی حداقل مرحله مورد نیاز {$content->level} است"
                        ]);
                    }
                    $contents = Content::where('type', 'STEP')->orWhere('type' , 'EVENT')->orWhere('type' , 'PREREQUISITES')->where('level', '<', $content->level)->get();
                    return $contents;
                    foreach($contents as $c) {
                        $userReadedContent = DB::table('user_content')->where('user_id' , $user->id)->where('content_id' , $c->_id)->first();
                        if (!$userReadedContent) {
                            return back()->with([
                                'status' => 'error',
                                'message' => $c->type == 'STEP' ? 'شما محتوای مرحله ای ' : ''
                            ]);
                        }
                    }
                }
                break;
            case 'INTRODUCTION':
            case 'JANEBI':
            case 'PREREQUISITES':
                return view('pages.content', compact('content'));
                break;
        }
    }
}
