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
        Schema::create('digital_menu_block_pb_options', function (Blueprint $table) {
            $table->id();
            $table->foreignId('digitalMenuBlock_id')->constrained('digital_menu_blocks')->cascadeOnDelete();
            $table->foreignId('pbOption_id')->constrained('pb_options');
            $table->string('title')->nullable();
            $table->string('connectionWay')->nullable();
            $table->string('extraText')->nullable();
            $table->integer('sort')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digital_menu_block_pb_options');
    }
};
