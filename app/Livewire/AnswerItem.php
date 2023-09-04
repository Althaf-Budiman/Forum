<?php

namespace App\Livewire;

use App\Models\Answer;
use Livewire\Component;

class AnswerItem extends Component
{
    public $answer;

    public function mount(Answer $answer)
    {
        $this->answer = $answer;
    }

    public function render()
    {
        return view('livewire.answer-item');
    }
}
