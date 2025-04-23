<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BuyingTransactionItemFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buying_transactions_items', function (Blueprint $table) {
            $table->foreignId('transaction_id')->constrained('buying_transactions');
            $table->foreignId('item_id')->constrained('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('buying_transactions_items', function (Blueprint $table) {
            $table->dropForeign('transaction_id');
            $table->dropForeign('item_id');
        });
    }
}
