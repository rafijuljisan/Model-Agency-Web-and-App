<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable(); // We use DOB to calculate exact age dynamically
            $table->integer('height_cm')->nullable(); // Sliders need pure numbers (e.g., 165)
            $table->json('languages')->nullable(); // JSON array for multiple languages
            
            // Hierarchical Location
            $table->string('country')->default('Bangladesh');
            $table->string('district')->nullable();
            $table->string('upazila')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn(['gender', 'date_of_birth', 'height_cm', 'languages', 'country', 'district', 'upazila']);
        });
    }
};