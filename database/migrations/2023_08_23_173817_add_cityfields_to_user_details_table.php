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
        Schema::table('user_details', function (Blueprint $table) {
            $table->string('city_name')->nullable()->after('referred_by');
            $table->string('state_name')->nullable()->after('referred_by');
            $table->string('country_name')->nullable()->after('referred_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn('city_name');
            $table->dropColumn('state_name');
            $table->dropColumn('country_name');
        });
    }
};
