<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        \Schema::table('block_options', function (Blueprint $table) {
            $table->string('blockVisibility')
                  ->default('true')
                  ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        //
    }
};
