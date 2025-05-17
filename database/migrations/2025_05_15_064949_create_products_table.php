<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
        Schema::create('products', function (Blueprint $table) {
            $table->id('id_product'); // nếu bạn đặt tên id là id_product
            $table->string('code')->unique();
            $table->string('name_product');
            $table->string('category');
            $table->integer('stock_quantity');
            $table->integer('price');
            $table->string('status');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
