<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Bookmark;
use App\Models\Comment;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AnswerItem extends Component
{
    // This property will be filled with argument from looping in detail view
    public $answer;

    // To get all comments from answer
    public $comments;

    // To set the view if the comment opened or no
    public bool $isCommentOpen;

    // Model for input in view
    public $comment;

    public function mount(Answer $answer)
    {
        $this->answer = $answer;
        $this->isCommentOpen = false;
    }

    public function addComment()
    {
        $user = Auth::user();

        $this->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'user_id' => $user->id,
            'answer_id' => $this->answer->id,
            'comment' => $this->comment
        ]);

        $this->comment = "";
        
        // Komen user yang ter-authentikasi
        $myComments = Comment::where('answer_id', $this->answer->id)
            ->where('user_id', $user->id)
            ->where('parent_id', null)
            ->orderByDesc('total_votes')
            ->get();

        // Komen user lain
        $otherComments = Comment::where('answer_id', $this->answer->id)
            ->where('user_id', '!=', $user->id)
            ->where('parent_id', null)
            ->orderByDesc('total_votes')
            ->get();

        $this->comments = $myComments->concat($otherComments);
    }

    public function loadComments()
    {
        $user = Auth::user();

        // Komen user yang ter-authentikasi
        $myComments = Comment::where('answer_id', $this->answer->id)
            ->where('user_id', $user->id)
            ->where('parent_id', null)
            ->orderByDesc('total_votes')
            ->get();

        // Komen user lain
        $otherComments = Comment::where('answer_id', $this->answer->id)
            ->where('user_id', '!=', $user->id)
            ->where('parent_id', null)
            ->orderByDesc('total_votes')
            ->get();

        $this->comments = $myComments->concat($otherComments);
        $this->isCommentOpen = !$this->isCommentOpen;
    }

    // Ketika button upvote diklik
    public function upvote($answerId)
    {
        $user = Auth::user();
        $answer = Answer::findOrFail($answerId);

        $existingVote = $answer->votes()->where('user_id', $user->id)->first();
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
                'answer_id' => $answer->id,
                'vote_type' => 'upvote',
                'vote_status' => 'upvote'
            ]);
        }
        $this->calculateTotalVotes($answer);
    }

    // Ketika button downvote diklik
    public function downvote($answerId)
    {
        $user = Auth::user();
        $answer = Answer::findOrFail($answerId);

        $existingVote = $answer->votes()->where('user_id', $user->id)->first();
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
                'answer_id' => $answer->id,
                'vote_type' => 'downvote',
                'vote_status' => 'downvote'
            ]);
        }
        $this->calculateTotalVotes($answer);
    }

    public function calculateTotalVotes($answer)
    {
        $answer->update([
            'total_votes' => $answer->votes()->where('vote_type', 'upvote')->count() - $answer->votes()->where('vote_type', 'downvote')->count()
        ]);
    }

    public function bookmark($answerId)
    {
        $user = Auth::user();
        $answer = Answer::findOrFail($answerId);

        $existingBookmark = $answer->bookmarks()->where('user_id', $user->id)->first();
        if ($existingBookmark) {
            $existingBookmark->delete();
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'bookmark_status' => 'bookmark',
                'answer_id' => $answer->id
            ]);
        }
    }

    public function render()
    {
        return view('livewire.answer-item');
    }
}
