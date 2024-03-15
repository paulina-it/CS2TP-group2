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
        Schema::table('customer_queries', function (Blueprint $table) {
            $table->enum('query_type', ['book request', 'order issue', 'payment issue','account access', 'product return','other'])
                ->default('other')
                ->nullable(false)
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_queries', function (Blueprint $table) {
            $table->enum('query_type', ['book request', 'order issue', 'payment issue','account access', 'other'])
                ->default('other')
                ->nullable(false)
                ->change();
        });
    }
};
