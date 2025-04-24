<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReportSellingTransactionFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('report_selling_transactions', function (Blueprint $table) {
            $table->foreignId('report_id')->constrained('reports');
            $table->foreignId('selling_transaction_id')->constrained('selling_transactions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('report_selling_transactions', function (Blueprint $table) {
            $table->dropForeign(['report_id']);
            $table->dropForeign(['selling_transaction_id']);
        });
    }
}
