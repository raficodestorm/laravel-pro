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
        Schema::create('buses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('coach_no');
            $table->string('license');
            $table->string('company');
            $table->string('bus_type');
            $table->string('route');
            $table->string('seat_layout');
            $table->integer('seat_capacity');
            $table->timestamps();
            $table->foreign('bus_type')->references('type')->on('bustypes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buses');
    }
};
