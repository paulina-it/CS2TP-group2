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
        Schema::dropIfExists('b_language');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('b_language', function (Blueprint $table) {
            $table->id('b_language_id');
            $table->bigInteger('language_id')->unsigned();
            $table->bigInteger('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->timestamps();
        });
    }
};
