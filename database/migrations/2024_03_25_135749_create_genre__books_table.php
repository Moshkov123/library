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
        Schema::create('genre__books', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('genre_id');
            $table->foreign('genre_id')->references('id')->on('genres');
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('genre__books');
    }
};
