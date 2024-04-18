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
        Schema::create('digital_menu_block_options', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('price');
            $table->tinyInteger('visibility')->default(1);
            $table->tinyInteger('sort')->default(0);
            $table->string('subtitle')->default(1);
            $table->foreignId('digitalMenuBlock_id')->constrained('digital_menu_blocks')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_menu_block_options');
    }
};
