<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AppController extends Controller
{
    public function index()
    {
        $kasbokars = Content::where('type' , 'INTRODUCTION')->latest()->get();
        $pres = Content::where('type' , 'PREREQUISITES')->get();
        $steps = Content::where('type' , 'STEP')->orderBy('level' , 'asc')->get();
        $contentsReadedId = [];
        if (auth()->check())
        {
            $user = auth()->user();
            $user_contents = DB::table('user_content')
                ->where('user_id' , $user->id)
                ->where('read' , true)
                ->get();
            foreach ($user_contents as $uc) {
                $contentsReadedId[] = $uc->content_id;
            }
        }
        return view('index' , ['kasbokars' => $kasbokars , 'steps' => $steps ,'pres' => $pres , 'contentsReadedId' => $contentsReadedId]);
    }
}
