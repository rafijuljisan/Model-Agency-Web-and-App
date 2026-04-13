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
    Schema::create('grooming_applications', function (Blueprint $table) {
        $table->id();
        $table->foreignId('batch_id')->constrained('grooming_batches')->cascadeOnDelete();
        $table->string('full_name');
        $table->string('phone');
        $table->string('whatsapp')->nullable();
        $table->string('email')->nullable();
        $table->unsignedInteger('age')->nullable();
        $table->enum('gender', ['Male', 'Female', 'Other'])->nullable();
        $table->string('height')->nullable();
        $table->string('weight')->nullable();
        $table->string('address')->nullable();
        $table->json('career_interests')->nullable();
        $table->enum('experience_level', ['Beginner', 'Intermediate', 'Experienced'])->nullable();
        $table->string('payment_method')->nullable();
        $table->string('transaction_id')->nullable()->unique();
        $table->string('payment_screenshot')->nullable();
        $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
        $table->enum('payment_status', ['unpaid', 'paid', 'verified'])->default('unpaid');
        $table->text('admin_note')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grooming_applications');
    }
};
