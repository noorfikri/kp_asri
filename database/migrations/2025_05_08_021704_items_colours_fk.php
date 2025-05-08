<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemsColoursFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_colours', function (Blueprint $table) {
            $table->foreignId('item_id')->constrained('items');
            $table->foreignId('colour_id')->constrained('colours');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_colours', function (Blueprint $table) {
            $table->dropForeign(['colour_id']);
            $table->dropForeign(['item_id']);
        });
    }
}
