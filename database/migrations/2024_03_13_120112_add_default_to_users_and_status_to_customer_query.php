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
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->nullable(false)->change();
        });

        Schema::table('customer_queries', function (Blueprint $table) {
            $table->enum('status', ['not reviewed', 'open', 'closed']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role')->default()->change();
        });

        Schema::table('customer_queries', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
