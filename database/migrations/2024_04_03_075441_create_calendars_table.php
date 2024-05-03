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
        Schema::create('calendars', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id');
            $table->integer('batch_id');
            $table->integer('tutor_id');
            $table->integer('curriculum_id')->nullable();
            $table->integer('teams_id');
            $table->string('subject')->nullable();
            $table->integer('classroom_id');
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendars');
    }
};
