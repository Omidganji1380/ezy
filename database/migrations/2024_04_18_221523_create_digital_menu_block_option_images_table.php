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
        Schema::create('digital_menu_block_option_images', function (Blueprint $table) {
            $table->id();
            $table->string('img');
            $table->foreignId('menuBlockOption_id')->constrained('digital_menu_block_options')->cascadeOnUpdate();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_menu_block_option_images');
    }
};
