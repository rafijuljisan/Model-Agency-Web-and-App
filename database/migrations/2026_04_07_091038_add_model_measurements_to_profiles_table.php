<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // Measurements
            $table->decimal('weight_kg', 5, 1)->nullable()->after('height_cm');
            $table->decimal('chest_bust_inches', 5, 1)->nullable()->after('weight_kg');
            $table->decimal('waist_inches', 5, 1)->nullable()->after('chest_bust_inches');
            $table->decimal('hips_inches', 5, 1)->nullable()->after('waist_inches');
            $table->decimal('shoulder_inches', 5, 1)->nullable()->after('hips_inches');
            $table->string('shoe_size')->nullable()->after('shoulder_inches');       // e.g. EU 42 / UK 8
            $table->string('dress_size')->nullable()->after('shoe_size');            // S, M, L, XL, XXL

            // Appearance
            $table->string('skin_tone')->nullable()->after('dress_size');            // Fair, Medium, Dusky, Deep
            $table->string('eye_color')->nullable()->after('skin_tone');
            $table->string('hair_color')->nullable()->after('eye_color');
            $table->string('hair_length')->nullable()->after('hair_color');          // Short, Medium, Long

            // Experience & Skills
            $table->string('experience_level')->nullable()->after('hair_length');    // Fresher, 1-3 Years, Professional
            $table->json('special_skills')->nullable()->after('experience_level');   // ['Driving','Swimming','Dancing']

            // Media
            $table->string('showreel_url')->nullable()->after('special_skills');     // YouTube/Vimeo link

            // Availability
            $table->boolean('willing_to_travel')->default(false)->after('showreel_url');
            $table->string('availability')->nullable()->after('willing_to_travel'); // Full-time, Part-time, Weekends

            // Social follower counts
            $table->unsignedBigInteger('instagram_followers')->nullable()->after('instagram_url');
            $table->unsignedBigInteger('tiktok_followers')->nullable()->after('tiktok_url');
            $table->unsignedBigInteger('facebook_followers')->nullable()->after('facebook_url');
        });
    }

    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropColumn([
                'weight_kg', 'chest_bust_inches', 'waist_inches', 'hips_inches',
                'shoulder_inches', 'shoe_size', 'dress_size', 'skin_tone', 'eye_color',
                'hair_color', 'hair_length', 'experience_level', 'special_skills',
                'showreel_url', 'willing_to_travel', 'availability',
                'instagram_followers', 'tiktok_followers', 'facebook_followers',
            ]);
        });
    }
};