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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('topTitle')->nullable();
            $table->string('infoTopTitle')->nullable();
            $table->string('resume')->nullable();
            $table->string('resumeButton')->nullable();
            $table->string('infoTitle')->nullable();
            $table->string('infoLocation')->nullable();
            $table->text('infoText')->nullable();
            $table->string('infoImg')->nullable();
            $table->string('videoTitle')->nullable();
            $table->string('videoImg')->nullable();
            $table->string('videoLink')->nullable();
            $table->string('midTopTitle')->nullable();
            $table->string('midTitle')->nullable();
            $table->string('midSubtitle')->nullable();
            $table->text('midDesc')->nullable();
            $table->string('midImg')->nullable();
            $table->string('skillTopTitle')->nullable();
            $table->string('skillTitle')->nullable();
            $table->tinyInteger('skillPercentage')->nullable();
            $table->string('bottomTopTitle')->nullable();
            $table->string('bottomTitle')->nullable();
            $table->string('bottomSubtitle')->nullable();
            $table->text('bottomText')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
