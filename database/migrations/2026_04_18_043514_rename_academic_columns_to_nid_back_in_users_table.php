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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('academic_certificate_path', 'nid_back_path');
            $table->renameColumn('academic_verification_status', 'nid_back_verification_status');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('nid_back_path', 'academic_certificate_path');
            $table->renameColumn('nid_back_verification_status', 'academic_verification_status');
        });
    }
};
