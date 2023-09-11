<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionAnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the question
        Question::create([
            'user_id' => 1,
            'title' => 'Gimana cara bikin controller di Laravel?',
            'category' => 'IT'
        ]);

        Question::create([
            'user_id' => 2,
            'title' => 'COD: Modern Warfare 3 Reboot.. apakah layak?',
            'category' => 'Video Game'
        ]);

        Question::create([
            'user_id' => 1,
            'title' => 'BOX!',
            'category' => 'Umum'
        ]);

        /* ------------------------------

            Create the answer

           ------------------------------ */ 
        Answer::create([
            'user_id' => 2,
            'question_id' => 1,
            'answer' => 'pake perintah artisan php artisan make:controller NamaController'
        ]);

        Answer::create([
            'user_id' => 3,
            'question_id' => 1,
            'answer' => 'kamu harus belajar perintah php artisan dulu dah'
        ]);

        Answer::create([
            'user_id' => 3,
            'question_id' => 2,
            'answer' => 'ga ah, biasa aja'
        ]);

        Answer::create([
            'user_id' => 2,
            'question_id' => 3,
            'answer' => 'BOX! dari satlat IDN'
        ]);

        Answer::create([
            'user_id' => 3,
            'question_id' => 3,
            'answer' => 'BOX!'
        ]);
    }
}
