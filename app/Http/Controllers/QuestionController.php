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

    public function upvote($id)
    {
        $user = Auth::user();
        $question = Question::findOrFail($id);

        // Unvote upvote
        $existingVote = $question->votes()->where('user_id', $user->id)->first();
        if ($existingVote) {
            if ($existingVote->vote_type === 'upvote') {
                $existingVote->delete();
            } else if ($existingVote->vote_type === 'downvote'){
                $existingVote->update([
                    'vote_type' => 'upvote'
                ]);
            }
        } else {
            // Upvote
            Vote::create([
                'user_id' => $user->id,
                'question_id' => $question->id,
                'vote_type' => 'upvote'
            ]);
        }
        
        return back();
    }

    public function downvote($id)
    {
        $user = Auth::user();
        $question = Question::findOrFail($id);

        // Unvote downvote
        $existingVote = $question->votes()->where('user_id', $user->id)->first();
        if ($existingVote) {
            if ($existingVote->vote_type === 'downvote') {
                $existingVote->delete();
            } else if ($existingVote->vote_type === 'upvote') {
                $existingVote->update([
                    'vote_type' => 'downvote'
                ]);
            }
        } else {
            // Downvote
            Vote::create([
                'user_id' => $user->id,
                'question_id' => $question->id,
                'vote_type' => 'downvote'
            ]);
        }
        
        return back();
    }
}
