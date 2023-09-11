<?php

namespace App\Livewire;

use App\Models\Question;
use App\Traits\VoteAndBookmarkable;
use Livewire\Component;

class QuestionItem extends Component
{
    use VoteAndBookmarkable;

    public $question;

    public function mount(Question $question)
    {
        $this->question = $question;
    }

    // when btn vote clicked in the view
    public function questionAddVote($voteType)
    {
        $this->addVote($this->question, $voteType);
        $this->questionTotalVotes();
    }

    // to calculate total votes so data can be ordered by total_votes
    public function questionTotalVotes()
    {
        $this->calculateTotalVotes($this->question);
    }

    // when btn bookmark clicked in the view
    public function questionAddBookmark()
    {
        $this->addBookmark($this->question);
    }

    public function render()
    {
        return view('livewire.question-item');
    }
}
