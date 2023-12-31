<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('vote_type');
            $table->enum('vote_status', ['upvote', 'empty', 'downvote'])->default('empty');
            // Pilih salah satu
            $table->foreignId('answer_id')->nullable()->constrained();
            $table->foreignId('question_id')->nullable()->constrained();
            $table->foreignId('comment_id')->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};
