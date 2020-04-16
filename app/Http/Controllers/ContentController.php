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
        $canSee = [
            'can' => true,
            'why' => '',
            'contents' => []
        ];
        $readed = false;
        $pre = Content::where('type', 'STEP')
            ->orWhere('type', 'EVENT')
            ->orWhere('type', 'PREREQUISITES')
            ->where('level', (string) ((int) $content->level - 1))
            ->first();
        $next = Content::where('type', 'STEP')
            ->orWhere('type', 'EVENT')
            ->orWhere('type', 'PREREQUISITES')
            ->where('level', (string) ((int) $content->level + 1))
            ->first();
        switch ($request->type) {
            case 'EVENT':
            case 'STEP':
                if (!auth()->check()) {
                    $canSee['can'] = false;
                    $canSee['why'] = 'login';
                    return view('pages.content', ['content' => $content, 'type' => $request->type, 'canSee' => $canSee, 'pre' => $pre, 'next' => $next ,'readed' => $readed]);
                } else {
                    $user = auth()->user();
                    if ($user->level < $content->level) {
                        $canSee['can'] = false;
                        $canSee['why'] = 'level';
                        return view('pages.content', ['content' => $content, 'type' => $request->type, 'canSee' => $canSee, 'pre' => $pre, 'next' => $next ,'readed' => $readed]);
                    }
                    $contents = Content::where('type', 'STEP')
                        ->orWhere('type', 'EVENT')
                        ->orWhere('type', 'PREREQUISITES')
                        ->orWhere('shouldJobs', 'like', "%{$user->workStatus}%")
                        ->where('level', '<', $content->level)
                        ->get();
                    $notReadedContents = [];
                    foreach ($contents as $c) {
                        $userReadedContent = DB::table('user_content')->where('user_id', $user->id)->where('content_id', $c->_id)->first();
                        if (!$userReadedContent) {
                            $notReadedContents[] = $c;
                        }
                    }
                    if (count($notReadedContents) == 0) {
                        $readed = DB::table('user_content')->where('user_id', auth()->user()->id)->where('content_id', $content->_id)->exists();
                        return view('pages.content', ['content' => $content, 'type' => $request->type, 'canSee' => $canSee, 'pre' => $pre, 'next' => $next ,'readed' => $readed]);
                    }
                    $canSee['can'] = false;
                    $canSee['why'] = 'content';
                    $canSee['contents'] = $notReadedContents;
                    return view('pages.content', ['content' => $content, 'type' => $request->type, 'canSee' => $canSee, 'pre' => $pre, 'next' => $next ,'readed' => $readed]);
                }
                break;
            case 'INTRODUCTION':
            case 'JANEBI':
                return view('pages.content', ['content' => $content, 'type' => $request->type]);
            case 'PREREQUISITES':
                if (auth()->check()) {
                    $readed = DB::table('user_content')->where('user_id', auth()->user()->id)->where('content_id', $content->_id)->exists();
                }
                return view('pages.content', ['content' => $content, 'type' => $request->type , 'pre' => $pre , 'next' => $next ,'readed' => $readed]);
                break;
        }
    }
}
