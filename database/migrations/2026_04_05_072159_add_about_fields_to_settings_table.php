<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->longText('about_text')->nullable();
            $table->string('about_image')->nullable();
            $table->text('mission_text')->nullable();
            $table->text('vision_text')->nullable();
            $table->longText('what_we_offer')->nullable();
            $table->longText('our_experience')->nullable();
            $table->longText('models_advice')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            $table->dropColumn([
                'about_text', 'about_image', 'mission_text', 'vision_text', 
                'what_we_offer', 'our_experience', 'models_advice'
            ]);
        });
    }
};