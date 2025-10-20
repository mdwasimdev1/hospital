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
        Schema::create('doctor_requests', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('personal_phone');
            $table->string('bmdc_number');
            $table->string('degrees');
            $table->string('fellowships')->nullable();
            $table->string('specialty');
            $table->string('workplace');
            $table->string('designation');
            $table->string('chamber_name');
            $table->string('chamber_address');
            $table->string('visiting_hour');
            $table->string('appointment_number');
            $table->string('bKash_transaction');
            $table->string('about');
            $table->string('photo'); // image path save korbe
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_requests');
    }
};
