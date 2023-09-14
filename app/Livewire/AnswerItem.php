<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Comment;
use App\Models\Notification;
use App\Traits\VoteAndBookmarkable;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AnswerItem extends Component
{
    use VoteAndBookmarkable;

    // This property will be filled with argument from looping in detail view
    public $answer;

    // To get all comments from answer
    public $comments;

    // To set the view if the comment opened or no
    public bool $isCommentOpen;

    // Model for input in view
    public $comment;

    // limiting the comment data
    public int $commentLimit = 5;

    // condition to show load button or no
    public bool $showLoadButton = false;

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

        $answerOwner = $this->answer;

        // Create notifications
        // Check if the answer owner is not the user commenting then create notification
        if ($answerOwner->user_id !== $user->id) {
            Notification::create([
                'user_id' => $answerOwner->user_id,
                'message' => "$user->name commented on the answer: '$answerOwner->answer'"
            ]);
        }

        $this->comment = "";
        $this->getCommentData();
    }

    public function openComments()
    {
        $this->getCommentData();
        $this->isCommentOpen = !$this->isCommentOpen;
    }

    // get comment datas 
    public function getCommentData()
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

        if ($otherComments->count() > $this->commentLimit) {
            $this->showLoadButton = true;
        } else {
            $this->showLoadButton = false;
        }

        $this->comments = $myComments->concat($otherComments->take($this->commentLimit));
    }

    public function loadMoreComments()
    {
        $this->commentLimit += 5;
        $this->getCommentData();
    }

    // when btn vote clicked in the view
    public function answerAddVote($voteType)
    {
        $this->addVote($this->answer, $voteType);
        $this->answerTotalVotes();
    }

    // to calculate total votes so data can be ordered by total_votes
    public function answerTotalVotes()
    {
        $this->calculateTotalVotes($this->answer);
    }

    public function render()
    {
        return view('livewire.answer-item');
    }
}
