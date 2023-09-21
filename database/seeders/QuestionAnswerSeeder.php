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
            'user_id' => 1, // nawfal
            'title' => 'Gimana cara bikin controller di Laravel?',
            'category' => 'IT'
        ]);

        Question::create([
            'user_id' => 2, // budiman
            'title' => 'Best COD Video Game ?',
            'category' => 'Video Game'
        ]);

        Question::create([
            'user_id' => 3, // apakah
            'title' => 'Mbappe jadi pindah kemana?',
            'category' => 'Umum'
        ]);

        Question::create([
            'user_id' => 2, // budiman
            'title' => 'Best Bodyweight Leg Exercise?',
            'category' => 'Umum'
        ]);

        /* ------------------------------

            Create the answer

           ------------------------------ */
        Answer::create([
            'user_id' => 2, // budiman pemilik answer
            'question_id' => 1, // nawfal pemilik question
            'answer' => 'pake perintah artisan php artisan make:controller NamaController'
        ]);

        Answer::create([
            'user_id' => 3, // apakah pemilik answer
            'question_id' => 1, // nawfal pemilik question
            'answer' => 'php artisan make:controller'
        ]);

        Answer::create([
            'user_id' => 1, // nawfal pemilik answer
            'question_id' => 2, // budiman pemilik question
            'answer' => 'Call Of Duty 4 : Modern Warfare imo'
        ]);

        Answer::create([
            'user_id' => 3, // apakah pemilik answer
            'question_id' => 2, // budiman pemilik question
            'answer' => 'Call Of Duty : Modern Warfare 2, storyline terbaik'
        ]);

        Answer::create([
            'user_id' => 1, // nawfal pemilik answer
            'question_id' => 3, // apakah pemilik question
            'answer' => 'stay psg'
        ]);

        Answer::create([
            'user_id' => 1, // nawfal pemilik answer
            'question_id' => 4, // budiman pemilik question
            'answer' => 'Pistol Squat best compound leg exercise. Tips: pegang beban di depan biar lebih gampang balancenya.'
        ]);

        Answer::create([
            'user_id' => 3, // apakah pemilik answer
            'question_id' => 4, // budiman pemilik question
            'answer' => 'Sissy Squat untuk quadricep, dan nordic hamstring curl untuk hamstring untuk menjadi atlet terbaik'
        ]);
    }
}
