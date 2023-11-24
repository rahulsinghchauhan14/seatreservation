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
        Schema::create('seats', function (Blueprint $table) {
            $table->id('seat_id');
            $table->integer('seat_number');
            $table->integer('row_number');
            $table->integer('coach_id');
            $table->boolean('is_booked')->default(0);
            $table->integer('booked_by')->default(0);
            $table->unique(['seat_number', 'row_number','coach_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};
