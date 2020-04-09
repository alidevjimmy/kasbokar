<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;

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
                    $contents = Content::where('type', 'STEP')->where('level', '<', $content->level)->get();
                    foreach ($contents as $c) {
                        $c
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
