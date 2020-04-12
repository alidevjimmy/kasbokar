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
        $janebies = Content::where('type' , 'JANEBI')->latest()->get();
        $pres = Content::where('type' , 'PREREQUISITES')->get();
        $stepsAndEvents = Content::where('type' , 'STEP')->orWhere('type' , 'EVENT')->orderBy('level' , 'asc')->get();
        $contentsReadedId = [];
        if (auth()->check())
        {
            $user = auth()->user();
            $user_contents = DB::table('user_content')
                ->where('user_id' , $user->id)
                ->get();
            foreach ($user_contents as $uc) {
                $contentsReadedId[] = $uc->content_id;
            }
        }
        return view('index' , [
            'kasbokars' => $kasbokars,
            'stepsAndEvents' => $stepsAndEvents,
            'pres' => $pres,
            'contentsReadedId' => $contentsReadedId,
            'janebies' => $janebies
        ]);
    }
}
