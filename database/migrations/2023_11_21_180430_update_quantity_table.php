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
        Schema::table('quantity', function (Blueprint $table) {
            $table->integer('ebook');
            $table->integer('hardcover');
            $table->integer('paperback');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('quantity', function (Blueprint $table) {
            $table->dropColumn('ebook');
            $table->dropColumn('hardcover');
            $table->dropColumn('paperback');
        });
    }
};
