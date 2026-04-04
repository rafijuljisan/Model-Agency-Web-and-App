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
    Schema::create('profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->string('category')->nullable(); // e.g., model, photographer, editor
        $table->text('bio')->nullable();
        $table->string('location')->nullable();
        $table->integer('hourly_rate')->nullable();
        $table->string('height')->nullable(); // mostly for models
        $table->string('weight')->nullable(); // mostly for models
        $table->json('social_links')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
