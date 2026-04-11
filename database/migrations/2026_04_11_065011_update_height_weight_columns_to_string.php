<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->string('height_cm', 20)->nullable()->change();
            $table->string('weight_kg', 20)->nullable()->change();
            $table->string('chest_bust_inches', 20)->nullable()->change();
            $table->string('waist_inches', 20)->nullable()->change();
            $table->string('hips_inches', 20)->nullable()->change();
            $table->string('shoulder_inches', 20)->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Restore to original types from your DB dump
            $table->integer('height_cm')->nullable()->change();
            $table->decimal('weight_kg', 5, 1)->nullable()->change();
            $table->decimal('chest_bust_inches', 5, 1)->nullable()->change();
            $table->decimal('waist_inches', 5, 1)->nullable()->change();
            $table->decimal('hips_inches', 5, 1)->nullable()->change();
            $table->decimal('shoulder_inches', 5, 1)->nullable()->change();
        });
    }
};