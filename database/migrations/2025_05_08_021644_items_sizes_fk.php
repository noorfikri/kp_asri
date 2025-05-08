<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemsSizesFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items_sizes', function (Blueprint $table) {
            $table->foreignId('item_id')->constrained('items');
            $table->foreignId('size_id')->constrained('sizes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items_sizes', function (Blueprint $table) {
            $table->dropForeign(['item_id']);
            $table->dropForeign(['size_id']);
        });
    }
}
