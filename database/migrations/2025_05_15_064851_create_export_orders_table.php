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
       Schema::create('export_orders', function (Blueprint $table) {
        $table->id('id_export');
        $table->unsignedBigInteger('id_user');
        $table->unsignedBigInteger('id_customer');
        $table->decimal('total_price', 10, 2)->default(0.00);
        $table->timestamp('create_at')->useCurrent();
       
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_orders');
    }
};
