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
        Schema::create('profile_themes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('premium')->default(0);
            $table->foreignId('background_image_id')->nullable()->constrained('profile_background_images')->cascadeOnDelete();
            $table->string('background_color')->nullable();
            $table->string('texts_color')->default('#000');
            $table->string('block_text_color')->default('#fff');
            $table->string('block_background_color')->default('#00aa00');
            $table->string('block_border_color')->default('#000');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_themes');
    }
};
