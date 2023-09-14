<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Models\Notification;
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

    // reply comment limit data
    public $replyDataLimit = 5;

    // condition to show load button or no
    public $showLoadButton = false;

    public function mount($comment)
    {
        $this->comment = $comment;
        $this->isReplying = false;
    }

    public function loadReply($parentId)
    {
        $this->getReplyData($parentId);
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

        $commentOwner = $this->comment;

        // Create notifications
        // Check if the comment owner is not the user commenting then create notification
        if ($commentOwner->user_id !== $user->id) {
            Notification::create([
                'user_id' => $commentOwner->user_id,
                'message' => "$user->name replied to the comment: '$commentOwner->comment' "
            ]);
        }

        $this->replyContent = "";

        $this->getReplyData($parentId);
    }

    // get reply data
    public function getReplyData($parentId)
    {
        $user = Auth::user();

        // Komen user yang ter-authentikasi
        $myComments = Comment::where('parent_id', $parentId)
            ->where('user_id', $user->id)
            ->where('parent_id', $this->comment->id)
            ->get();

        // Komen user lain
        $otherComments = Comment::where('parent_id', $parentId)
            ->where('user_id', '!=', $user->id)
            ->where('parent_id', $this->comment->id)
            ->get();

        if ($otherComments->count() > $this->replyDataLimit) {
            $this->showLoadButton = true;
        } else {
            $this->showLoadButton = false;
        }

        $this->replies = $myComments->concat($otherComments->take($this->replyDataLimit));
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

    public function loadMoreReply($parentId)
    {
        $this->replyDataLimit += 5;
        $this->getReplyData($parentId);
    }


    public function render()
    {
        return view('livewire.comment-item');
    }
}
