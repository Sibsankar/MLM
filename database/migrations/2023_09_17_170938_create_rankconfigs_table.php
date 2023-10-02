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
        Schema::create('rankconfigs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rank_id')->unsigned()->index()->nullable();
            $table->string('performance_target')->nullable();
            $table->string('commission_cat')->nullable();
            $table->string('commission_type')->nullable();
            $table->string('guaranteed_prize')->nullable();
            $table->string('conveyance')->nullable();
            $table->string('percentage')->nullable();
            $table->string('multiple_by')->nullable();
            $table->string('amount')->nullable();
            $table->timestamps();
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rankconfigs');
    }
};
