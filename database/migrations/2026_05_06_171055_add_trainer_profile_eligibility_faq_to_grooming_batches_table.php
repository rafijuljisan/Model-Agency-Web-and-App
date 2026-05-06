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
        Schema::table('grooming_batches', function (Blueprint $table) {
            $table->string('trainer_image')->nullable()->after('trainer');
            $table->string('trainer_designation')->nullable()->after('trainer_image');
            $table->text('trainer_bio')->nullable()->after('trainer_designation');
            $table->json('eligibility')->nullable()->after('course_modules');
            $table->json('faqs')->nullable()->after('eligibility');
        });
    }

    public function down(): void
    {
        Schema::table('grooming_batches', function (Blueprint $table) {
            $table->dropColumn([
                'trainer_image', 'trainer_designation', 'trainer_bio',
                'eligibility', 'faqs',
            ]);
        });
    }
};
