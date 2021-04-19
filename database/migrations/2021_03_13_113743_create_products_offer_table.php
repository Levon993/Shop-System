<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsOfferTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_offer', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigInteger('product_id')->unsigned();
            $table->bigInteger('offer_id')->unsigned();
//            $table->foreign('product_id')
//                ->references('id')->on('products')
//                ->onDelete('cascade')
//                ->onUpdate('cascade');
//            $table->foreign('offer_id')
//                ->references('id')->on('offers')
//                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_offer');
    }
}
