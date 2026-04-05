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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            
            // Branding
            $table->string('site_name')->default('My Talent Agency');
            $table->text('site_description')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            
            // Contact & Socials
            $table->string('contact_email')->nullable();
            $table->string('contact_phone')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            
            // Payment Gateways
            $table->string('bkash_number')->nullable();
            $table->string('bkash_type')->default('Send Money'); // Send Money vs Payment
            
            $table->string('nagad_number')->nullable();
            $table->string('nagad_type')->default('Send Money');
            
            $table->string('rocket_number')->nullable();
            $table->string('rocket_type')->default('Send Money');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
