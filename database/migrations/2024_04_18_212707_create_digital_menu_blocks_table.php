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
        Schema::create('digital_menu_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('digitalMenu_id')->constrained('digital_menus')->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->string('banner')->nullable();
            $table->tinyInteger('visibility')->default(1);
            $table->tinyInteger('sort')->default(0);
            $table->string('currency')->default('USD');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_menu_blocks');
    }
};
