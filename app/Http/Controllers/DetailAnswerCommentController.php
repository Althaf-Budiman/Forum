<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Comment;

class DetailAnswerCommentController extends Controller
{
    public function detailAnswer($id)
    {
        $answer = Answer::findOrFail($id);
        $questionTarget = $answer->question;

        return view('detail-answer', compact('answer', 'questionTarget'));
    }

    public function detailComment($id)
    {
        $comment = Comment::findOrFail($id);
        $answerTarget = $comment->answer;

        return view("detail-comment", compact('comment', 'answerTarget'));
    }
}
