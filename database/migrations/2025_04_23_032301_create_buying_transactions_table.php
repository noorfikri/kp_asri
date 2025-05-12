<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyingTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buying_transactions', function (Blueprint $table) {
            $table->id();
            $table->date('date')->default(now());
            $table->integer('total_amount')->default(0);
            $table->integer('total_count')->default(0);
            $table->integer('sub_total')->default(0);
            $table->integer('discount_amount')->default(0);
            $table->integer('other_cost')->default(0);
            $table->string('reciept_image')->default('assets/img/Placeholder_Image.png');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('buying_transactions');
    }
}
