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
        Schema::create('block_pb_options', function (Blueprint $table) {
            $table->foreignId('block_id')->constrained('blocks')->cascadeOnDelete();
            $table->foreignId('pbOption_id')->constrained('pb_options');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('block_pb_options');
    }
};
