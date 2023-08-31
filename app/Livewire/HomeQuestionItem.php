<?php

namespace App\Livewire;

use App\Models\Question;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class HomeQuestionItem extends Component
{
    public $questions;

    public function mount()
    {
        $this->questions = Question::orderBy('total_votes', 'DESC')->get();

        foreach ($this->questions as $question) {
            $question->update([
                'total_votes' => $question->votes()->where('vote_type', 'upvote')->count() - $question->votes()->where('vote_type', 'downvote')->count()
            ]);
        }
    }

    // Ketika button upvote diklik
    public function upvote($questionId)
    {
        $user = Auth::user();
        $question = Question::findOrFail($questionId);

        $existingVote = $question->votes()->where('user_id', $user->id)->first();
        if ($existingVote) {
            if ($existingVote->vote_type === 'upvote') {
                $existingVote->delete();
            } else if ($existingVote->vote_type === 'downvote') {
                $existingVote->update([
                    'vote_type' => 'upvote',
                    'vote_status' => 'upvote'
                ]);
            }
        } else {
            Vote::create([
                'user_id' => $user->id,
                'question_id' => $question->id,
                'vote_type' => 'upvote',
                'vote_status' => 'upvote'
            ]);
        }
        foreach ($this->questions as $question) {
            $question->update([
                'total_votes' => $question->votes()->where('vote_type', 'upvote')->count() - $question->votes()->where('vote_type', 'downvote')->count()
            ]);
        }
    }

    // Ketika button downvote diklik
    public function downvote($questionId)
    {
        $user = Auth::user();
        $question = Question::findOrFail($questionId);

        $existingVote = $question->votes()->where('user_id', $user->id)->first();
        if ($existingVote) {
            if ($existingVote->vote_type === 'downvote') {
                $existingVote->delete();
            } else if ($existingVote->vote_type === 'upvote') {
                $existingVote->update([
                    'vote_type' => 'downvote',
                    'vote_status' => 'downvote'
                ]);
            }
        } else {
            Vote::create([
                'user_id' => $user->id,
                'question_id' => $question->id,
                'vote_type' => 'downvote', 
                'vote_status' => 'downvote'
            ]);
        }
        foreach ($this->questions as $question) {
            $question->update([
                'total_votes' => $question->votes()->where('vote_type', 'upvote')->count() - $question->votes()->where('vote_type', 'downvote')->count()
            ]);
        }
    }

    public function render()
    {
        return view('livewire.home-question-item');
    }
}
