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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->string('associate_name');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('user_id');
            $table->string('sponsor_code');
            $table->string('rank');
            $table->date('dob');
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
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};
