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
        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->time('time');
            $table->double('regular_price');
            $table->double('child_price');
            $table->double('old_price');
            $table->double('discount');
            $table->foreignId('movie_id')->constrained('movies')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('room_id')->constrained('rooms')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('screenings');
    }
};
