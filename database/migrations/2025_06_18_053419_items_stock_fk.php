<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemsStockFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_stock', function (Blueprint $table) {
            $table->foreign('item_id')->references('id')->on('items');
            $table->foreign('size_id')->references('id')->on('sizes');
            $table->foreign('colour_id')->references('id')->on('colours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_stock', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropForeign(['size_id']);
            $table->dropForeign(['colour_id']);
        });
    }
}
