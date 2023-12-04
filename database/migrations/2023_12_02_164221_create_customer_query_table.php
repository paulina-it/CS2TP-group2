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
        Schema::create('customer_query', function (Blueprint $table) {
            $table->id('query_id');
            $table->string('forename');
            $table->string('surname');
            $table->string('email');
            $table->enum('query_type', ['book request', 'order_issue', 'payment_issue', 'account_access', 'other']);
            $table->longText('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_query');
    }
};
