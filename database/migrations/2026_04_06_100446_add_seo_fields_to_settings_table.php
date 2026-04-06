<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_add_seo_fields_to_settings_table.php
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Basic SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_image')->nullable(); // Social share image

            // Verification & Analytics
            $table->string('google_analytics_id')->nullable();   // G-XXXXXXXXXX
            $table->string('google_tag_manager_id')->nullable(); // GTM-XXXXXXX
            $table->string('google_search_console_id')->nullable(); // verification meta tag content
            $table->string('facebook_pixel_id')->nullable();

            // Sitemap & Robots
            $table->boolean('sitemap_enabled')->default(true);
            $table->text('robots_txt')->nullable(); // custom robots.txt content

            // Schema / Structured Data
            $table->string('schema_org_type')->default('Organization'); // Organization, LocalBusiness etc
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'meta_title',
                'meta_description',
                'meta_keywords',
                'og_image',
                'google_analytics_id',
                'google_tag_manager_id',
                'google_search_console_id',
                'facebook_pixel_id',
                'sitemap_enabled',
                'robots_txt',
                'schema_org_type',
            ]);
        });
    }
};
