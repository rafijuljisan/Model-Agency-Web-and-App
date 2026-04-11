<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('artist_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Type: 'film', 'tv_drama', 'award', 'jury', 'commercial', 'theater', 'music_video', 'other'
            $table->string('type', 50);
            
            // Common fields for all types
            $table->string('title');           // Film name, Show name, Award name
            $table->string('year', 10)->nullable();  // "2021", "2021-2023"
            
            // For Film / TV / Commercial / Theater / Music Video
            $table->string('role', 255)->nullable();       // Character name
            $table->string('director', 255)->nullable();   // Director name
            $table->string('production', 255)->nullable(); // Production house
            $table->text('notes')->nullable();             // "Debut Film", "Debut Hindi Film"
            
            // For Awards
            $table->string('award_category', 255)->nullable(); // "Best Actress"
            $table->string('award_work', 255)->nullable();     // Work it was for
            $table->enum('award_result', ['Won', 'Nominated'])->nullable();
            
            // For Jury
            $table->string('jury_festival', 255)->nullable();  // "I Am Tomorrow Film Festival"
            $table->string('jury_location', 255)->nullable();  // "Brussels"
            $table->string('jury_category', 255)->nullable();  // "Asian films Competition"
            
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['user_id', 'type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('artist_experiences');
    }
};