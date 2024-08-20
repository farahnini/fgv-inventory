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
         // Add column role
        Schema::table('users', function (Blueprint $table) {
            $table->string('station')->nullable()->after('role');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop column role
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('station');
        });
    }
};
