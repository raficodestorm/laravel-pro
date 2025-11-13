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
        Schema::create('booked_seats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservation_id')->references('id')->on('seat_reservations')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('counter_id')->nullable()->constrained('counters');
            $table->foreignId('schedule_id')->constrained('schedules');
            $table->string('coach_no');
            $table->string('booked_seats');
            $table->integer('total');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booked_seats');
    }
};
