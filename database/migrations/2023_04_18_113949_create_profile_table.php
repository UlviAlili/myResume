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
        Schema::create('profile', function (Blueprint $table) {
            $table->id();
            $table->string('main_title');
            $table->text('about_text');
            $table->string('btn_contact_text')->nullable();
            $table->string('small_title_left')->nullable();
            $table->string('small_title_right')->nullable();
            $table->string('full_name');
            $table->string('image')->nullable();
            $table->string('job_name');
            $table->string('website');
            $table->string('phone');
            $table->string('mail');
            $table->string('location');
            $table->string('cv');
            $table->text('languages');
            $table->text('interests');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
