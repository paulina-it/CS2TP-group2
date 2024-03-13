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
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'processed', 'completed', 'shipped', 'cancelled', 'refunded', 'partially refunded')");

        Schema::table('guest', function (Blueprint $table) {
            $table->dropUnique('guest_phone_unique');
            $table->dropUnique('guest_email_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN status ENUM('pending', 'processed', 'completed', 'shipped', 'cancelled', 'refunded')");

        Schema::table('guest', function (Blueprint $table) {
            $table->unique('phone');
            $table->unique('email');
        });
    }
};
