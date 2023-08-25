<?php

namespace App\Http\Controllers;

use App\Models\Question;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        $questions = Question::all();
        return view('home', compact('questions'));
    }
}
