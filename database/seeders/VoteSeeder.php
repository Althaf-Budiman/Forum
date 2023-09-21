<?php

namespace Database\Seeders;

use App\Models\Vote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // budiman upvotes:

        Vote::create([
            'user_id' => 2,
            'vote_type' => 'upvote',
            'vote_status' => 'upvote',
            'question_id' => 1
        ]);

        Vote::create([
            'user_id' => 2,
            'vote_type' => 'upvote',
            'vote_status' => 'upvote',
            'answer_id' => 1
        ]);

        Vote::create([
            'user_id' => 2,
            'vote_type' => 'upvote',
            'vote_status' => 'upvote',
            'comment_id' => 1
        ]);

        Vote::create([
            'user_id' => 2,
            'vote_type' => 'upvote',
            'vote_status' => 'upvote',
            'question_id' => 2
        ]);

        Vote::create([
            'user_id' => 2,
            'vote_type' => 'upvote',
            'vote_status' => 'upvote',
            'answer_id' => 4
        ]);

        Vote::create([
            'user_id' => 2,
            'vote_type' => 'upvote',
            'vote_status' => 'upvote',
            'answer_id' => 6
        ]);

        // nawfal upvotes
        Vote::create([
            'user_id' => 1,
            'vote_type' => 'upvote',
            'vote_status' => 'upvote',
            'question_id' => 1
        ]);

        Vote::create([
            'user_id' => 1,
            'vote_type' => 'upvote',
            'vote_status' => 'upvote',
            'question_id' => 4
        ]);

        Vote::create([
            'user_id' => 1,
            'vote_type' => 'upvote',
            'vote_status' => 'upvote',
            'answer_id' => 5
        ]);

        // apakah vote
        Vote::create([
            'user_id' => 3,
            'vote_type' => 'upvote',
            'vote_status' => 'upvote',
            'question_id' => 3
        ]);
    }
}
