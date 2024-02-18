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
        Schema::create('profile_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->cascadeOnDelete();
            $table->foreignId('font_id')->nullable()->constrained('profile_fonts')->nullOnDelete();
            $table->foreignId('background_image_id')->nullable()->constrained('profile_background_images')->nullOnDelete();
            $table->foreignId('theme_id')->nullable()->constrained('profile_themes')->nullOnDelete();
            $table->string('texts_color')->nullable();
            $table->string('background_color')->nullable();
            $table->string('block_background_color')->nullable();
            $table->string('block_text_color')->nullable();
            $table->string('block_border_color')->nullable();
            $table->string('block_rounded')->default('rounded');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_options');
    }
};
