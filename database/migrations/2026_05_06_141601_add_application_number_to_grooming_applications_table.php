<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('grooming_applications', function (Blueprint $table) {
        // Limited to 50 characters to prevent the 1071 key length error
        $table->string('application_number', 50)->nullable()->unique()->after('id');
    });
}

    public function down()
    {
        Schema::table('grooming_applications', function (Blueprint $table) {
            $table->dropColumn('application_number');
        });
    }
};
