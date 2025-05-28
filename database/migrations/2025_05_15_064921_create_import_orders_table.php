<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('import_orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id_import');
            $table->unsignedBigInteger('supplier_id');
            $table->unsignedBigInteger('user_id');
            $table->decimal('total_price', 10, 2)->default(0.00);
            $table->timestamp('import_date')->useCurrent();
            $table->decimal('import_price', 10, 2)->default(0.00);


        });
    }

    public function down(): void
    {
        Schema::dropIfExists('import_orders');
    }
};