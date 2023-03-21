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
        Schema::create('order_vendor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->decimal('wallet', $precision = 8, $scale = 2)->nullable();
            $table->string('otp')->nullable();
            $table->string('cod_pending')->nullable();
            $table->boolean('is_admin')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('deleted')->default(false);
            $table->timestamps();
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
