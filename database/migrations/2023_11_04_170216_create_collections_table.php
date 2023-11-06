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
        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('aadhar')->nullable();
            $table->string('segment')->nullable();
            $table->string('amount')->nullable();
            $table->string('txnid')->nullable();
            $table->text('payment_details')->nullable();
            $table->text('payment_image')->nullable();
            $table->enum('is_approved',['Approve', 'Reject'])->nullable();
            $table->unsignedBigInteger('user_id');   
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collections');
    }
};
