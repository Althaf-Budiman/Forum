<?php

namespace App\Livewire;

use App\Models\Comment;
use App\Traits\VoteAndBookmarkable;
use Livewire\Component;

class ReplyItem extends Component
{
    use VoteAndBookmarkable;

    // used in the view as a represent data of each reply data
    public $reply;

    public function mount(Comment $reply)
    {
        $this->reply = $reply;
    }

    // when btn vote clicked in the view
    public function replyAddVote($voteType)
    {
        $this->addVote($this->reply, $voteType);
        $this->replyTotalVotes();
    }

    // to calculate total votes so data can be ordered by total_votes
    public function replyTotalVotes()
    {
        $this->calculateTotalVotes($this->reply);
    }

    public function render()
    {
        return view('livewire.reply-item');
    }
}
