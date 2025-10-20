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
        Schema::create('payment_condintions', function (Blueprint $table) {
            $table->id();
            $table->text('introduction')->nullable();
            $table->text('payment_process')->nullable();
            $table->string('number')->nullable();
            $table->text('apply_process')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_condintions');
    }
};
