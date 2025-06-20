<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BuyingTransactionsItemsFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('buying_transactions_items', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('buying_transactions')->onDelete('cascade');
            $table->foreign('items_stock_id')->references('id')->on('items_stock')->onDelete('cascade');
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
            $table->dropForeign(['transaction_id']);
            $table->dropForeign(['items_stock_id']);
        });
    }
}
