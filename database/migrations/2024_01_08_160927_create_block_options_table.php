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
        Schema::create('block_options', function (Blueprint $table) {
            $table->id();
            $table->string('blockTitle')->nullable();
            $table->string('blockWidth')->default('full')->comment('full - half - compress');
            $table->string('blockBorder')->default('rounded');
            $table->tinyInteger('blockVisibility')->default(1);
            $table->string('option1')->nullable();
            $table->string('option2')->nullable();
            $table->string('option3')->nullable();
            $table->string('option4')->nullable();
            $table->string('option5')->nullable();
            $table->foreignId('block_id')->constrained('blocks')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_options');
    }
};
