<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReportBuyingTransactionFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('report_buying_transactions', function (Blueprint $table) {
            $table->foreignId('report_id')->constrained('reports');
            $table->foreignId('buying_transaction_id')->constrained('buying_transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_buying_transactions', function (Blueprint $table) {
            $table->dropForeign(['report_id']);
            $table->dropForeign(['buying_transaction_id']);
        });
    }
}
