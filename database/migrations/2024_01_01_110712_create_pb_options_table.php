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
        Schema::create('pb_options', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('icon')->nullable();
            $table->string('color')->nullable();
            $table->string('for')->nullable();
            $table->string('title_en')->nullable();
            $table->string('icon_en')->nullable();
            $table->string('color_en')->nullable();
            $table->string('for_en')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pb_options');
    }
};
