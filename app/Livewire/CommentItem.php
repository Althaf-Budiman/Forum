<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Vote;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentItem extends Component
{
    public $comment;

    public function mount($comment)
    {
        $this->comment = $comment;
    }

    // Ketika button upvote diklik
    public function upvote($commentId)
    {
        $user = Auth::user();
        $comment = Comment::findOrFail($commentId);

        $existingVote = $comment->votes()->where('user_id', $user->id)->first();
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
                'comment_id' => $comment->id,
                'vote_type' => 'upvote',
                'vote_status' => 'upvote'
            ]);
        }
        $this->calculateTotalVotes($comment);
    }

    // Ketika button downvote diklik
    public function downvote($commentId)
    {
        $user = Auth::user();
        $comment = Comment::findOrFail($commentId);

        $existingVote = $comment->votes()->where('user_id', $user->id)->first();
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
                'comment_id' => $comment->id,
                'vote_type' => 'downvote',
                'vote_status' => 'downvote'
            ]);
        }
        $this->calculateTotalVotes($comment);
    }

    public function calculateTotalVotes($comment)
    {
        $comment->update([
            'total_votes' => $comment->votes()->where('vote_type', 'upvote')->count() - $comment->votes()->where('vote_type', 'downvote')->count()
        ]);
    }


    public function render()
    {
        return view('livewire.comment-item');
    }
}
