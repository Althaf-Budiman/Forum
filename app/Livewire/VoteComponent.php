<?php

namespace App\Livewire;

use App\Models\Question;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class VoteComponent extends Component
{
    public $question;

    public $isUpvoted;
    public $isDownvoted;

    public function mount(Question $question)
    {
        $this->question = $question;
        $this->isUpvoted = false;
        $this->isDownvoted = false;
    }

    // Ketika button upvote diklik
    public function upvote()
    {
        $user = Auth::user();

        $existingVote = $this->question->votes()->where('user_id', $user->id)->first();
        if ($existingVote) {
            if ($existingVote->vote_type === 'upvote') {
                $this->isUpvoted = false;
                $existingVote->delete();
            } else if ($existingVote->vote_type === 'downvote') {
                $existingVote->update([
                    'vote_type' => 'upvote'
                ]);
                $this->isUpvoted = true;
                $this->isDownvoted = false;
            }
        } else {
            Vote::create([
                'user_id' => $user->id,
                'question_id' => $this->question->id,
                'vote_type' => 'upvote'
            ]);
            $this->isUpvoted = true;
        }
    }

    // Ketika button downvote diklik
    public function downvote()
    {
        $user = Auth::user();

        $existingVote = $this->question->votes()->where('user_id', $user->id)->first();
        if ($existingVote) {
            if ($existingVote->vote_type === 'downvote') {
                $this->isDownvoted = false;
                $existingVote->delete();
            } else if ($existingVote->vote_type === 'upvote') {
                $existingVote->update([
                    'vote_type' => 'downvote'
                ]);
                $this->isDownvoted = true;
                $this->isUpvoted = false;
            }
        } else {
            Vote::create([
                'user_id' => $user->id,
                'question_id' => $this->question->id,
                'vote_type' => 'downvote'
            ]);
            $this->isDownvoted = true;
        }
    }

    public function render()
    {
        return view('livewire.vote-component');
    }
}
