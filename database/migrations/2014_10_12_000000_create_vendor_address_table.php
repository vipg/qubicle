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
        Schema::create('vendor_address', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vendor_id');
            $table->string('locationName')->nullable();
            $table->double('latitude')->nullable();
            $table->double('longitude')->nullable();
            $table->integer('buildingNumber')->nullable();
            $table->integer('streetNumber')->nullable();
            $table->string('municipality')->nullable();
            $table->integer('zoneNumber')->nullable();
            $table->string('mapLink')->nullable();
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
