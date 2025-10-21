<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_info', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('');
            $table->text('description');
            $table->text('address');
            $table->string('banner')->default('');
            $table->string('logo')->nullable();
            $table->string('phone')->default('');
            $table->string('whatsapp')->default('');
            $table->string('navbar_color', 20)->default('#ffffff');
            $table->string('bottom_bar_color', 20)->default('#f8f9fa');
            $table->string('text_color', 20)->default('#000000');
            $table->string('text_secondary_color', 20)->default('#666666');
            $table->string('home_image')->nullable();
            $table->string('storefront_image')->nullable();
            $table->string('map_image')->nullable();
            $table->text('address_description')->nullable();
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
        Schema::dropIfExists('store_info');
    }
}
