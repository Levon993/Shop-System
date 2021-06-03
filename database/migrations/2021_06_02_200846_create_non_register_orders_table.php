<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNonRegisterOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('non_register_orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->bigIncrements('id');
            $table->bigInteger('address_id')->unsigned()->nullable();
            $table->enum('status',['0','1','2'])->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->string('currency',10);
            $table->text('note')->nullable();
            $table->float('sum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('non_register_orders');
    }
}
