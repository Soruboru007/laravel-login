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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id') // The category that the question belongs to
                ->constrained() // Automatically references the 'id' column of the 'answer_sessions' table
                ->onDelete('cascade'); // If an answer session is deleted, its associated questions will also be deleted
            $table->string('question');
            $table->string('answer');
            $table->json('options');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
