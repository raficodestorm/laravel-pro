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
        Schema::create('seat_reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('schedule_id')->constrained()->onDelete('cascade');
            $table->string('bus_type');
            $table->string('coach_no');
            $table->string('route');
            $table->decimal('seat_price', 10, 2);
            $table->string('departure');
            $table->string('boarding');
            $table->string('dropping');
            $table->string('selected_seats');
            $table->decimal('total', 10, 2);
            $table->string('status')->nullable();
            $table->string('name');
            $table->string('mobile');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seat_reservations');
    }
};
