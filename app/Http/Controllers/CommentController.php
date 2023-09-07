<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, $answerId)
    {
        $user = Auth::user();

        $request->validate([
            'comment' => 'required'
        ]);

        Comment::create([
            'user_id' => $user->id,
            'answer_id' => $answerId,
            'comment' => $request->comment
        ]);

        return back();
    }
}
