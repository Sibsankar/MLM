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
        Schema::create('users_details_org', function (Blueprint $table) {
            $table->id();
            $table->string('associate_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('sponsor_code')->nullable();
            $table->string('rank')->nullable();
            $table->date('dob')->nullable();
            $table->enum('gender', ['Male', 'Female'])->nullable();
            $table->longText('pan_no')->nullable(); 
            $table->longText('aadhar_no')->nullable();
            $table->longText('email')->nullable();          
            $table->string('phone_no')->nullable();
            $table->string('percentage_cat')->nullable();
            $table->enum('is_active', ['0', '1'])->default('0');
            $table->longText('address_line1')->nullable();
            $table->longText('address_line2')->nullable();
            $table->integer('state')->nullable();
            $table->integer('country')->nullable();
            $table->integer('city')->nullable();
            $table->string('pin')->nullable();
            $table->string('referred_by')->nullable();
            $table->string('country_name')->nullable();
            $table->string('state_name')->nullable();
            $table->string('city_name')->nullable();
            $table->string('ifc_code')->nullable();
            $table->string('account_number')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_holder_name')->nullable();
            $table->string('relation_with_nominee')->nullable();
            $table->string('nominee_Name')->nullable();
            $table->string('district')->nullable();
            $table->string('guardians_name')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users_details_org');
    }
};
