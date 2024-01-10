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
        Schema::create('info_form_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('infoForm_id')->constrained('info_forms')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_form_options');
    }
};
