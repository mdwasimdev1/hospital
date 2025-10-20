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
        Schema::create('advertisements', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->text('conditions')->nullable();
            $table->text('position_priority')->nullable();
            $table->text('transparency')->nullable();
            $table->text('pricing_policy')->nullable();
            $table->text('display_policy')->nullable();
            $table->text('renewal_policy')->nullable();
            $table->text('rights_and_preparation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('advertisements');
    }
};
