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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('book_name');
            $table->string('author');
            $table->string('genre');
            $table->longText('description');
            $table->string('ISBN')->unique();
            $table->enum('language', ['latin', 'polish', 'punjabi', 'romanian', 'russian', 'spanish', 'urdu']);
            $table->string('mainImage');
            $table->string('otherImages');
            $table->integer('quantity')->default(1);
            $table->enum('type', ['ebook', 'hardcover', 'paperback']);
            $table->float('price', 5, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
