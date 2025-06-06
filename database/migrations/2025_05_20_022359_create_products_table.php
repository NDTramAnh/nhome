<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {




        Schema::create('products', function (Blueprint $table) {
            $table->id('id');
            $table->string('name', 225);
            $table->string('category', 225);
           
            $table->decimal('price', 10, 2);
            $table->integer('quantity')->default(0);
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
