<?php

namespace Database\Seeders;

use App\Models\Comment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentReplySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* ------------------------------

            Create the Comments and Replies

           ------------------------------ */

        Comment::create([
            'user_id' => 1,
            'answer_id' => 1,
            'comment' => 'ok thank you',
        ]);

        Comment::create([
            'user_id' => 2,
            'answer_id' => 1,
            'parent_id' => 1,
            'comment' => 'sama-sama',
        ]);

        Comment::create([
            'user_id' => 1,
            'answer_id' => 1,
            'comment' => 'betul sih ini',
        ]);

        Comment::create([
            'user_id' => 1,
            'answer_id' => 2,
            'comment' => 'baiklah...',
        ]);

        Comment::create([
            'user_id' => 2,
            'answer_id' => 3,
            'comment' => 'Lebih bagus daripada yang kedua',
        ]);

        Comment::create([
            'user_id' => 1,
            'answer_id' => 4,
            'comment' => 'BOX!',
        ]);

        Comment::create([
            'user_id' => 2,
            'answer_id' => 4,
            'parent_id' => 7,
            'comment' => 'BOX!'
        ]);
    }
}
