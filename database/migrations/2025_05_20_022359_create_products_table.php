<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
<<<<<<< HEAD:database/migrations/2025_05_20_022359_create_products_table.php
        Schema::create('products', function (Blueprint $table) {

            $table->id('id');
            $table->string('name');
             $table->string('category');
=======
        
       Schema::create('products', function (Blueprint $table) {
            $table->id('id_product');
            $table->string('name_product', 225);
            $table->string('category', 225);
>>>>>>> import_crud:database/migrations/2025_05_15_064949_create_products_table.php
            $table->decimal('price', 10, 2);
            $table->integer('quantity');
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

