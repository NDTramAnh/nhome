<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('export_orders', function (Blueprint $table) {
            $table->id(); 
            $table->unsignedBigInteger('id_user');      
            $table->string('id_customer')->nullable();   
            $table->decimal('total_price', 10, 2)->default(0.00);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('export_orders');
    }
};
