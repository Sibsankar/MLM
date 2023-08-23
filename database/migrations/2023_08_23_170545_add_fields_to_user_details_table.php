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
            $table->string('guardians_name')->nullable()->after('referred_by');
            $table->string('district')->nullable()->after('referred_by');
            $table->string('nominee_Name')->nullable()->after('referred_by');
            $table->string('relation_with_nominee')->nullable()->after('referred_by');
            $table->string('account_holder_name')->nullable()->after('referred_by');
            $table->string('bank_name')->nullable()->after('referred_by');
            $table->string('branch_name')->nullable()->after('referred_by');
            $table->string('account_number')->nullable()->after('referred_by');
            $table->string('ifc_code')->nullable()->after('referred_by');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_details', function (Blueprint $table) {
            //
            $table->dropColumn('guardians_name');
            $table->dropColumn('district');
            $table->dropColumn('nominee_Name');
            $table->dropColumn('relation_with_nominee');
            $table->dropColumn('account_holder_name');
            $table->dropColumn('bank_name');
            $table->dropColumn('branch_name');
            $table->dropColumn('account_number');
            $table->dropColumn('ifc_code');
        });
    }
};
