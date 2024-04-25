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
        Schema::create('registers', function (Blueprint $table) {
            $table->id();
            $table->datetime('date');
            $table->boolean('is_open');
            $table->datetime('open_at');
            $table->datetime('closed_at');
            $table->double('open_cash_amount');
            $table->double('cash_amount');
            $table->double('total_cash_amount');
            $table->double('debit_amount');
            $table->double('credit_amount');
            $table->double('total_amount');
            $table->foreignId('user_id')->constrained('users')
                ->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registers');
    }
};
