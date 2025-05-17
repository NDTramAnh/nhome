<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('import_orders', function (Blueprint $table) {
            $table->foreign('supplier_id')->references('id_supplier')->on('suppliers')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('import_orders', function (Blueprint $table) {
            $table->dropForeign(['supplier_id']);
        });
    }
};
