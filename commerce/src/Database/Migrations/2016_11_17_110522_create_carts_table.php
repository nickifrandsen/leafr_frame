<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher')->nullable()->default(null);
            $table->integer('shipping_method_id')->unsigned()->nullable()->default(null);
            $table->foreign('shipping_method_id')->references('id')->on('shipping_methods');
            $table->string('session_id');
            
            $table->string('identifier')->nullable()->default(null);

            $table->timestamps();
        });

        Schema::create('cart_items', function (Blueprint $table) {
            $table->increments('id');

            $table->string('description');

            $table->string('sku');
            $table->foreign('sku')->references('sku')->on('skus');

            $table->integer('quantity');

            $table->integer('cart_id')->unsigned();
            $table->foreign('cart_id')->references('id')->on('carts');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts_items');
        Schema::dropIfExists('carts');
    }
}
