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
        Schema::table('grooming_batches', function (Blueprint $table) {
            $table->longText('description')->nullable()->after('title');
            $table->json('benefits')->nullable()->after('description');
            $table->json('course_modules')->nullable()->after('benefits');
        });
    }

    public function down(): void
    {
        Schema::table('grooming_batches', function (Blueprint $table) {
            $table->dropColumn(['description', 'benefits', 'course_modules']);
        });
    }
};
