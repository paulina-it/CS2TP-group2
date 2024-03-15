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
    Schema::create('orders', function (Blueprint $table) {
        $table->id('id');
        $table->enum('status', ['pending', 'processed', 'completed', 'shipped', 'cancelled', 'refunded']);
        $table->date('ordered_date');
        $table->bigInteger('user_id')->unsigned()->nullable();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        // $table->bigInteger('payment_id')->unsigned();
        // $table->foreign('payment_id')->references('id')->on('payment')->onDelete('cascade');
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
