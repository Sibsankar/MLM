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
        Schema::create('commision_type', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');   
            $table->string('type_name');
            $table->enum('status', ['1', '0'])->nullable();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('commission_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commision_type');
    }
};