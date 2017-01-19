<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier')->unique();
            $table->string('name');
            $table->text('description');
        });

        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('slug')->unique();
            $table->string('sku')->nullable();
            $table->string('name');
            $table->text('description');

            $table->float('weight' , 7 , 3)->nullable()->default(null);
            $table->float('cost_price', 9 , 2)->nullable();
            $table->float('sale_price', 9 , 2)->nullable();
            $table->float('unit_price', 9 , 2);

            $table->integer('product_type_id')->unsigned()->nullable();
            $table->foreign('product_type_id')->references('id')->on('product_types');

            // It can have a reference to the suppliers table or be NULL
            $table->integer('supplier_id')->unsigned()->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers');

            // It can have a reference to the brands table or be NULL
            $table->integer('brand_id')->unsigned()->nullable();
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->boolean('has_variations')->default(0);
            $table->boolean('is_online')->default(0);

            $table->text('meta')->nullable()->default(null);

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('product_attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('identifier')->unique();
            $table->string('name');
            $table->string('description')->nullable();

            // Contains information about what extra info should be available on product variation
            // e.g. color variations could have a color picker
            $table->string('feature')->nullable();

        });

        Schema::create('product_attribute_values', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');

            $table->integer('attribute_id')->unsigned();
            $table->foreign('attribute_id')->references('id')->on('product_attributes');
        });


        Schema::create('skus', function (Blueprint $table) {
            $table->string('sku')->primary()->unique();
            $table->integer('product_id')->unsigned();

            $table->float('weight' , 7 , 3)->nullable()->default(null);
            $table->float('cost_price', 9 , 2)->nullable();
            $table->float('sale_price', 9 , 2)->nullable();
            $table->float('unit_price', 9 , 2);

            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();

            // Implements a timestamp if the product is deleted otherwise it will return NULL
            $table->softDeletes();
        });

        Schema::create('product_variations', function (Blueprint $table) {
            $table->increments('id');

            $table->string('sku');
            $table->foreign('sku')->references('sku')->on('skus');

            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')->references('id')->on('products');

            $table->integer('attribute_id')->unsigned();
            $table->foreign('attribute_id')->references('id')->on('product_attributes');

            $table->integer('value_id')->unsigned();
            $table->foreign('value_id')->references('id')->on('product_attribute_values');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('product_attribute_values');
        Schema::drop('product_attributes');
        Schema::drop('product_variations');
        Schema::drop('skus');
        Schema::drop('products');
        Schema::drop('product_types');
    }
}
