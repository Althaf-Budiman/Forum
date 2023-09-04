<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerController extends Controller
{
    public function detailQuestion($id)
    {
        $question = Question::findOrFail($id);
        $answers = Answer::where('question_id', $question->id)->orderByDesc('total_votes')->get();
        return view('detail-question', compact('question', 'answers'));
    }

    public function store(Request $request, $questionId)
    {
        $user = Auth::user();

        $request->validate([
            'answer' => 'required'
        ]);

        Answer::create([
            'user_id' => $user->id,
            'question_id' => $questionId,
            'answer' => $request->answer
        ]);

        return back();
    }
}
