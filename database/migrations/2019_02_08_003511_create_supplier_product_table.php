<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_product', function (Blueprint $table) {
            $table->increments('id')->index();
            $table->integer('product_id')->unsigned()->index(); // increments type generate unsigned integer!
            $table->integer('supplier_id')->unsigned()->index(); // increments type generate unsigned integer!
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade') ;
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade') ;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_product');
    }
}
