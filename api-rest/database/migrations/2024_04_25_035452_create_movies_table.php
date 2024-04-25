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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->string('description', 1024);
            $table->string('directors', 128);
            $table->string('actors', 128);
            $table->string('video_path', 128);
            $table->string('img_path', 128);
            $table->integer('duration');
            $table->string('category', 8);
            $table->string('gender', 64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
