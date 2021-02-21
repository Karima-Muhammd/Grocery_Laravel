<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string("order_id");
            $table->string('product_name');
            $table->float('product_price');
            $table->string('product_quantity');
            $table->float('total_price')->default(0);
            $table->string('img');
            $table->foreignId('user_id')->constrained();
            $table->enum('status',['Processed','Shipped','En Route','Arrived'])->default('Processed');
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
        Schema::dropIfExists('orders');
    }
}
