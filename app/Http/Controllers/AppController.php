<?php

namespace App\Http\Controllers;

use App\Content;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function index()
    {
        $kasbokars = Content::where('type' , 'INTRODUCTION')->latest()->get();
        $pres = Content::where('type' , 'PREREQUISITES')->get();
        return view('index' , ['kasbokars' => $kasbokars , 'pres' => $pres]);
    }
}
