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
        Schema::create('vendor_vehicle_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id');
            $table->decimal('carPrice')->nullable();
            $table->decimal('pickupPrice')->nullable();
            $table->decimal('twowheelerPrice')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
