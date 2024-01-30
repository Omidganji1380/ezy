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
        Schema::table('block_options', function (Blueprint $table) {
            $table->tinyInteger('blockItemColor')->default(2);
            $table->string('bgBlockItemColor')->nullable();
            $table->string('textBlockItemColor')->nullable();
            $table->string('borderBlockItemColor')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('block_options', function (Blueprint $table) {
            //
        });
    }
};
