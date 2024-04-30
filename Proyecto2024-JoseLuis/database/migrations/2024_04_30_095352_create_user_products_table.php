<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_products', function (Blueprint $table) {
            $table->id()->autoincrement();
            $table->string('name', 50);
            $table->decimal('price', 6, 2);
            $table->text('description');
            $table->enum('category', ['Electrodomésticos', 'Moda y accesorios', 'Móviles', 'Muebles', 'Informática']);
            $table->string('image');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_products');
    }
};
