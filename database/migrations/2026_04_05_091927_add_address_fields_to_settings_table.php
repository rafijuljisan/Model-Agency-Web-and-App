<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->text('contact_address')->nullable();
            $table->string('business_hours')->nullable();
            $table->text('google_map_embed_url')->nullable(); // For the map iframe src
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn(['contact_address', 'business_hours', 'google_map_embed_url']);
        });
    }
};