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
        Schema::create('digital_menus', function (Blueprint $table) {
            $table->id();
            $table->string('link')->unique();
            $table->string('image')->nullable();
            $table->string('cover')->nullable();
            $table->string('image_border')->default('100')->comment('100% - 30% - 10% - 0%');
            $table->string('cover_border')->default('0')->comment('100');
            $table->string('title');
            $table->string('subtitle')->nullable();
            $table->string('background')->nullable();
            $table->string('buttons_cover')->nullable();
            $table->string('buttons_title_color')->nullable();
            $table->string('buttons_icons_color')->nullable();
            $table->string('buttons_border_color')->nullable();
            $table->string('table_count')->nullable();
            $table->foreignId('scroll_id')->nullable()->constrained('scrolls')->nullOnDelete();
            $table->foreignId('template_id')->nullable()->constrained('templates')->nullOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnUpdate();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_menus');
    }
};
