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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone');

            $table->foreignId('hospital_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->foreignId('specialization_id')->constrained()->onDelete('cascade');

            $table->string('designation');
            $table->string('photo')->nullable(); // Main doctor profile image

            // ✅ New fields:
            $table->text('about')->nullable();                // Doctor's biography or intro
            $table->text('meta_title')->nullable();           // SEO title tag
            $table->text('meta_description')->nullable();     // SEO description tag
            $table->json('preview_images')->nullable();       // Store multiple image filenames/paths
            $table->string('video_links')->nullable();          // Store multiple video URLs

            $table->timestamps();
        });

    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
