<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('grooming_batches', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->json('schedule_json')->nullable(); // days/times
            $table->string('trainer')->nullable();
            $table->unsignedInteger('seat_limit')->default(20);
            $table->unsignedInteger('filled_seats')->default(0);
            $table->decimal('fee', 10, 2)->default(0);
            $table->enum('status', ['open', 'filling_fast', 'full', 'closed'])->default('open');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grooming_batches');
    }
};
