<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBasketStoreProductTable extends Migration
{
    public function up()
    {
        Schema::create('basket_store_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('basket_id')->constrained()->onDelete('cascade');
            $table->foreignId('store_product_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 6, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('basket_store_product');
    }
}
