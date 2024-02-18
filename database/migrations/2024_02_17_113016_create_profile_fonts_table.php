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
        Schema::create('profile_fonts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('language')->default('fa');
            $table->tinyInteger('premium')->default(0);
            $table->string('woff')->nullable();
            $table->string('woff2')->nullable();
            $table->string('eot')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_fonts');
    }
};
