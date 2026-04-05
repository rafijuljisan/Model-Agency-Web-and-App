<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('casting_calls', function (Blueprint $table) {
            $table->id();
            
            // Header Info
            $table->string('title');
            $table->string('type')->nullable(); // e.g., 'TVC & Photoshoot'
            $table->string('status')->default('Open'); // e.g., 'Open', 'Urgent', 'Closed'
            
            // Requirements
            $table->string('age_range')->nullable(); // e.g., '5 - 30 Years'
            $table->string('gender')->nullable(); // e.g., 'Male & Female'
            $table->string('experience')->nullable(); // e.g., 'Fresh faces welcome'
            $table->string('deadline')->nullable(); // e.g., 'Closing Soon'
            
            // Content
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('casting_calls');
    }
};