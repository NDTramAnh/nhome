<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        
       Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('name_product', 225);
            $table->string('category', 225);
            $table->decimal('price', 10, 2);
            $table->integer('stock_quantity')->default(0);
            $table->timestamp('create_at')->useCurrent();
            $table->timestamp('update_at')->useCurrent();
            $table->integer('status')->default(1);
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

