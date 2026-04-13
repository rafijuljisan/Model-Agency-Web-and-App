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
    Schema::create('grooming_notices', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('message');
        $table->enum('priority', ['critical', 'normal', 'low'])->default('normal');
        $table->boolean('show_on_grooming')->default(true);
        $table->boolean('show_on_homepage')->default(false);
        $table->boolean('is_active')->default(true);
        $table->timestamp('expires_at')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grooming_notices');
    }
};
