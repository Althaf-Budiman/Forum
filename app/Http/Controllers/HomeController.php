<?php

namespace App\Http\Controllers;

use App\Models\Question;

class HomeController extends Controller
{
    public function home()
    {
        $questions = Question::all();
        return view('home', compact('questions'));
    }
}
