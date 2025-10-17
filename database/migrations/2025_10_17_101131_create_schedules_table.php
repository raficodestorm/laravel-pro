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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->date('set_date');
            $table->time('set_time');
            $table->string('route_code');
            $table->string('start_location');
            $table->string('end_location');
            $table->string('distance')->nullable();
            $table->string('duration')->nullable();
            $table->decimal('price', 10, 2);
            $table->string('bus_type');
            $table->string('coach_no');
            $table->timestamps();
            $table->foreign('route_code')->references('route_code')->on('routes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
