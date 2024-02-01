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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('form_factor');
            $table->string('serial_number')->unique();
            $table->string('imei')->unique();
            $table->foreignId('device_manufacturer_id')->constrained();
            $table->foreignId('device_model_id')->constrained();
            $table->string('operating_system');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('sim_card_id')->constrained();
            $table->timestamp('deactivated_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
