<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('info_form_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('infoForm_id')->constrained('info_forms')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->integer('qty')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_form_products');
    }
};
