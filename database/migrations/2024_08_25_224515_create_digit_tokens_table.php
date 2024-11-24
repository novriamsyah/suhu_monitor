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
        Schema::create('digit_tokens', function (Blueprint $table) {
            $table->id();
            $table->string('tarif_token')->nullable();
            $table->string('kwh')->nullable();
            $table->string('digit_token')->nullable();
            $table->string('status')->nullable()->default(0);
            $table->foreignId('kwh_id')->nullable()->constrained('id_kwh')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('digit_tokens');
    }
};
