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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('topTitle')->nullable();
            $table->string('formTopTitle')->nullable();
            $table->string('infoTopTitle')->nullable();
            $table->tinyInteger('position')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('icon')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('text')->nullable();
            $table->string('topTitle_en')->nullable();
            $table->string('formTopTitle_en')->nullable();
            $table->string('infoTopTitle_en')->nullable();
            $table->string('title_en')->nullable();
            $table->string('subtitle_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
