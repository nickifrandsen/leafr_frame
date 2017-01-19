<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoryTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('product_id')->unsigned();
            $table->string('sku');
            $table->integer('in')->nullable();
            $table->integer('out')->nullable();
            $table->float('price', 9 , 2)->nullable()->default(null);
            $table->string('origin')->comment('Holds the origin of the transaction e.g order, new stock');
            $table->timestamps();

            $table->foreign('sku')->references('sku')->on('skus');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory_transactions');
    }
}
