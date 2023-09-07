<?php

namespace App\Livewire;

use App\Models\Bookmark;
use App\Models\Question;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class QuestionItem extends Component
{
    public $question;

    public bool $isDetailPage;

    public function mount(Question $question, bool $isDetailPage)
    {
        $this->question = $question;
        $this->isDetailPage = $isDetailPage;
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
        $this->calculateTotalVotes($question);
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
        $this->calculateTotalVotes($question);
    }

    public function calculateTotalVotes($question)
    {
        $question->update([
            'total_votes' => $question->votes()->where('vote_type', 'upvote')->count() - $question->votes()->where('vote_type', 'downvote')->count()
        ]);
    }

    public function bookmark($questionId)
    {
        $user = Auth::user();
        $question = Question::findOrFail($questionId);

        $existingBookmark = $question->bookmarks()->where('user_id', $user->id)->first();
        if ($existingBookmark) {
            $existingBookmark->delete();
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'bookmark_status' => 'bookmark',
                'question_id' => $question->id
            ]);
        }
    }

    public function render()
    {
        return view('livewire.question-item');
    }
}
