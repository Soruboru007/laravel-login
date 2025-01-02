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
        Schema::create('answer_sessions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained() // Automatically references the 'id' column of the 'users' table
                ->onDelete('cascade'); // If a user is deleted, its associated answer sessions will also be deleted
            $table->foreignId('category_id')
                ->constrained() // Automatically references the 'id' column of the 'categories' table
                ->onDelete('cascade'); // If a category is deleted, its associated answer sessions will also be deleted
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('answer_sessions');
    }
};
