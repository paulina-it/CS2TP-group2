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
        Schema::dropIfExists('price');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('price', function (Blueprint $table) {
            $table->id('book_price_id');
            $table->bigInteger('book_id')->unsigned();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->integer('ebook');
            $table->integer('hardcover');
            $table->integer('paperback');
            $table->timestamps();
        });
    }
};
