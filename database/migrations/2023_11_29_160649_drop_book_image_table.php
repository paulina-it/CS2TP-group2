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
        Schema::dropIfExists('book_image');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('book_image', function (Blueprint $table) {
            $table->id('book_image_id');
            $table->bigInteger('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->timestamps();
            $table->string('ebook');
            $table->string('hardcover');
            $table->string('paperback');
        });
    }
};