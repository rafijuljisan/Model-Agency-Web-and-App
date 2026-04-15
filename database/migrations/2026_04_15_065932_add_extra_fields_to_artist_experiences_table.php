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
        Schema::table('artist_experiences', function (Blueprint $table) {
            $table->text('description')->nullable()->after('notes');
            $table->string('language')->nullable()->after('description');
            $table->string('platform')->nullable()->after('language');
            $table->string('award_organizer')->nullable()->after('award_result');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('artist_experiences', function (Blueprint $table) {
            //
        });
    }
};
