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
<<<<<<< HEAD
=======
        Schema::table('order_item', function (Blueprint $table) {
            $table->dropForeign('order_item_order_id_foreign');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('order_id', 'id');
        });

        Schema::table('order_item', function (Blueprint $table) {
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
        });
>>>>>>> origin/develop
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
<<<<<<< HEAD
=======
        Schema::table('orders', function (Blueprint $table) {
            $table->dropForeign('order_item_id_foreign');
        });

        Schema::table('orders', function (Blueprint $table) {
            $table->renameColumn('id', 'order_id');
        });

        Schema::table('order_item', function (Blueprint $table) {
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
        });
>>>>>>> origin/develop
    }
};
