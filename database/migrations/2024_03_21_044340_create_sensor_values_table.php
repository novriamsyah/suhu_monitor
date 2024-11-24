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
        Schema::create('sensor_values', function (Blueprint $table) {
            $table->id();
            $table->decimal('tegangan', 10, 2)->nullable();
            $table->decimal('arus', 10, 2)->nullable();
            $table->decimal('dy_aktif', 10, 2)->nullable();
            $table->decimal('dy_reaktif', 10, 2)->nullable();
            $table->decimal('dy_semu', 10, 2)->nullable();
            $table->decimal('frekuensi', 5, 2)->nullable();
            $table->decimal('energi', 10, 4)->nullable();
            $table->string('biaya')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensor_values');
    }
};
