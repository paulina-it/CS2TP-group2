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
        DB::statement("ALTER TABLE books MODIFY COLUMN language ENUM('polish', 'romanian', 'punjabi', 'urdu', 'spanish', 'latin', 'russian') NOT NULL DEFAULT 'russian'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE books MODIFY COLUMN language ENUM('polish', 'romanian', 'punjabi', 'urdu', 'spanish', 'latin') NOT NULL DEFAULT 'polish'");
    }
};
