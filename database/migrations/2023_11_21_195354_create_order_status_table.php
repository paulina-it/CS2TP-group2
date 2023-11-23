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
        Schema::create('order_status', function (Blueprint $table) {
            $table->id('order_status_id');
            $table->enum('status', ['pending', 'processed', 'completed', 'shipped', 'cancelled', 'refunded']);
            $table->date('ordered_date');
            $table->bigInteger('order_id')->unsigned();
            $table->foreign('order_id')->references('order_id')->on('order')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('payment_id')->unsigned();
            $table->foreign('payment_id')->references('payment_id')->on('payment')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_status');
    }
};
