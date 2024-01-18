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
        Schema::table('pb_options', function (Blueprint $table) {
            $table->string('linkTitle')->nullable();
            $table->string('linkTitle_en')->nullable();
            $table->string('link')->nullable();
            $table->string('linkDescription')->nullable();
            $table->string('linkDescription_en')->nullable();
            $table->string('moreDescription')->nullable();
            $table->string('moreDescription_en')->nullable();
            $table->string('moreOptionTitle')->nullable();
            $table->string('moreOptionTitle_en')->nullable();
            $table->string('moreOptionDescription')->nullable();
            $table->string('moreOptionDescription_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pb_options', function (Blueprint $table) {
            //
        });
    }
};
