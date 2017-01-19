<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_no');
            $table->string('invoice_no')->default(null);
            $table->float('subtotal', 9 , 2);
            $table->float('total', 9 , 2);
            $table->float('shipping', 9 , 2)->nullable()->default(null);
            $table->float('discount', 9 , 2)->nullable()->default(null);
            $table->string('voucher')->nullable()->default(null);
            $table->string('status');
            $table->string('track_and_trace')->nullable()->default(null);
            $table->text('notes')->nullable()->default(null);

            $table->string('delivery_name');
            $table->string('delivery_address');
            $table->string('delivery_zipcode');
            $table->string('delivery_city');
            $table->string('delivery_country');

            $table->integer('shipping_method_id');
            $table->string('parcel')->nullable()->default(null);
            $table->string('parcel_shop')->nullable()->default(null);

            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers');

            $table->text('json_product_lines');

            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('order_products', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->string('sku');
            $table->foreign('sku')->references('sku')->on('skus');

            $table->integer('order_id')->unsigned();
            $table->foreign('order_id')->references('id')->on('orders');

            $table->string('description');

            $table->integer('quantity');

            $table->float('unit_price', 9 , 2);
            $table->float('subtotal', 9 , 2);

            $table->text('variations')->nullable()->default(null);

            $table->index('order_id');
        });

        Schema::create('shipping_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier');
            $table->string('name');
            $table->text('description');
            $table->float('unit_price', 9, 2);
            $table->float('free_above', 9, 2)->nullable()->default(null);
            $table->string('tracking_url')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_products');
        Schema::dropIfExists('shipping_methods');
        Schema::dropIfExists('orders');

    }
}
