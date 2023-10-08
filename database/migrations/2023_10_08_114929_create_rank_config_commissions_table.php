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
        Schema::create('rank_config_commissions', function (Blueprint $table) {
            $table->bigInteger('rank_id')->unsigned()->index()->nullable();
            $table->bigInteger('phase_id')->unsigned()->index()->nullable();
            $table->string('commission_cat')->nullable();
            $table->string('commission_type')->nullable();
            $table->string('percentage')->nullable();
            $table->string('amount')->nullable();
            $table->timestamps();
            $table->foreign('rank_id')->references('id')->on('ranks')->onDelete('cascade');
            $table->foreign('phase_id')->references('id')->on('phases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rank_config_commissions');
    }
};
