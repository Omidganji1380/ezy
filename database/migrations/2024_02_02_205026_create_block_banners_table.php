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
        Schema::create('block_banners', function (Blueprint $table) {
            $table->id();
            $table->foreignId('block_id')->constrained('blocks')->cascadeOnDelete();
//            $table->foreignId('pbOption_id')->constrained('pb_options');
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('button')->nullable();
            $table->integer('sort')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_banners');
    }
};
