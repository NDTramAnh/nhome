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
        Schema::create('import_orders_detail', function (Blueprint $table) {
              $table->id();
            $table->unsignedBigInteger('id_import');
            $table->unsignedBigInteger('id_product');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_orders_detail');
    }
};
