<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Traits\VoteAndBookmarkable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommentItem extends Component
{
    use VoteAndBookmarkable;

    // used in the view foreach loop
    public $comment;

    public bool $isReplying;

    // model reply in view
    public $replyContent;

    // replies collection
    public $replies;

    public function mount($comment)
    {
        $this->comment = $comment;
        $this->isReplying = false;
    }

    public function loadReply($parentId)
    {
        $user = Auth::user();

        // Komen user yang ter-authentikasi
        $myComments = Comment::where('parent_id', $parentId)
            ->where('user_id', $user->id)
            ->where('parent_id', $this->comment->id)
            ->orderByDesc('total_votes')
            ->get();

        // Komen user lain
        $otherComments = Comment::where('parent_id', $parentId)
            ->where('user_id', '!=', $user->id)
            ->where('parent_id', $this->comment->id)
            ->orderByDesc('total_votes')
            ->get();

        $this->replies = $myComments->concat($otherComments);

        $this->isReplying = !$this->isReplying;
    }

    public function replyComment($parentId)
    {

        $user = Auth::user();
        $targetComment = Comment::findOrFail($parentId);

        $this->validate([
            'replyContent' => 'required'
        ]);

        Comment::create([
            'user_id' => $user->id,
            'answer_id' => $targetComment->answer_id,
            'parent_id' => $parentId,
            'comment' => $this->replyContent
        ]);

        $this->replyContent = "";

        // Komen user yang ter-authentikasi
        $myComments = Comment::where('parent_id', $parentId)
            ->where('user_id', $user->id)
            ->where('parent_id', $this->comment->id)
            ->orderByDesc('total_votes')
            ->get();

        // Komen user lain
        $otherComments = Comment::where('parent_id', $parentId)
            ->where('user_id', '!=', $user->id)
            ->where('parent_id', $this->comment->id)
            ->orderByDesc('total_votes')
            ->get();

        $this->replies = $myComments->concat($otherComments);
    }

    // when btn vote clicked in the view
    public function commentAddVote($voteType)
    {
        $this->addVote($this->comment, $voteType);
        $this->commentTotalVotes();
    }

    // to calculate total votes so data can be ordered by total_votes
    public function commentTotalVotes()
    {
        $this->calculateTotalVotes($this->comment);
    }


    public function render()
    {
        return view('livewire.comment-item');
    }
}
