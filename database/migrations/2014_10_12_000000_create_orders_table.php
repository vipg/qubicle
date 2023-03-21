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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->mediumInteger('orderNumber');
            $table->string('customerName')->nullable();
            $table->mediumInteger('customerNumber')->nullable();
            $table->string('customerPhone')->nullable();
            $table->dateTime('pickupDate')->nullable();
            $table->string('pickupSlot')->nullable();
            $table->integer('packageWeight')->nullable();
            $table->decimal('deliveryCharge', $precision = 8, $scale = 2)->nullable();
            $table->decimal('amountPaid', $precision = 8, $scale = 2)->nullable();
            $table->string('packagePaymentType')->nullable();
            $table->decimal('amountToBeCollected', $precision = 8, $scale = 2)->nullable();
            $table->string('pickUpVehicle')->nullable();
            $table->string('addInfo')->nullable();
            $table->string('deliveryType')->nullable();
            $table->dateTime('deliveryDate')->nullable();
            $table->string('deliverySlot')->nullable();
            $table->string('paymentType')->nullable();
            $table->string('status')->nullable();
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
