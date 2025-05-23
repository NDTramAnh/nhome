<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id('id_supplier');
            $table->string('name_supplier');
            $table->string('phone_supplier', 10);
            $table->string('email');
            $table->text('address');
            $table->timestamp('create_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
