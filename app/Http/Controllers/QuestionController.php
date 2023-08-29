<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    public function home()
    {
        $questions = Question::all();

        return view('home', compact('questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required'
        ]);

        $user = Auth::user();

        Question::create([
            'user_id' => $user->id,
            'title' => $request->title,
            'description' => $request->description,
            'category' => $request->category
        ]);

        return redirect('/');
    }
}
