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
        Schema::dropIfExists('website_rating');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('website_rating', function (Blueprint $table) {
            $table->id();
            $table->enum('score', ['1', '2', '3', '4', '5']);
            $table->string('feedback');
            $table->string('help_needed');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }
};