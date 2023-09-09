<?php

namespace App\Livewire;

use App\Models\Answer;
use App\Models\Comment;
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

    // when btn bookmark clicked in the view
    public function answerAddBookmark()
    {
        $this->addBookmark($this->answer);
    }

    public function render()
    {
        return view('livewire.answer-item');
    }
}
