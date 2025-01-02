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
        Schema::create('answers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')
                ->constrained() // Automatically references the 'id' column of the 'questions' table
                ->onDelete('cascade'); // If a question is deleted, its associated answers will also be deleted
            $table->foreignId('answer_session_id')
                ->constrained() // Automatically references the 'id' column of the 'answer_sessions' table
                ->onDelete('cascade'); // If an answer session is deleted, its associated answers will also be deleted
            $table->string('answer');
            $table->boolean('is_correct');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answers');
    }
};
