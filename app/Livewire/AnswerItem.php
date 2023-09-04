<?php

namespace App\Livewire;

use App\Models\Question;
use Livewire\Component;

class AnswerItem extends Component
{
    public $question;

    public function mount(Question $question)
    {
        $this->question = $question;
    }

    public function render()
    {
        return view('livewire.answer-item');
    }
}
