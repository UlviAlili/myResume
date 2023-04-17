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
        Schema::table('experience', function (Blueprint $table) {
            $table->integer('order')->change();
            $table->string('company')->change();
            $table->string('position')->change();
            $table->string('experience_date')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('experience', function (Blueprint $table) {
            //
        });
    }
};
