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
        Schema::create('info_form_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('infoFormProduct_id')->constrained('info_form_products')->cascadeOnDelete();
            $table->string('file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_form_files');
    }
};
