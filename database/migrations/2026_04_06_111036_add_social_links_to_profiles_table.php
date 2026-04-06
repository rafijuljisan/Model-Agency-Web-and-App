<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_add_social_links_to_profiles_table.php
public function up(): void
{
    Schema::table('profiles', function (Blueprint $table) {
        $table->string('facebook_url')->nullable();
        $table->string('instagram_url')->nullable();
        $table->string('youtube_url')->nullable();
        $table->string('tiktok_url')->nullable();
        $table->string('linkedin_url')->nullable();
        $table->string('portfolio_url')->nullable(); // External portfolio link
    });
}

public function down(): void
{
    Schema::table('profiles', function (Blueprint $table) {
        $table->dropColumn([
            'facebook_url', 'instagram_url', 'youtube_url',
            'tiktok_url', 'linkedin_url', 'portfolio_url',
        ]);
    });
}
};
