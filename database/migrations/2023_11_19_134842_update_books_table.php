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
        Schema::table('books', function(Blueprint $table) {
            $table->string('email');
            $table->string('image');
            $table->integer('stock')->default(0);
            $table->bigInteger('book_price')->unsigned();
            $table->foreign('book_price')->references('book_price_id')->on('price')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
