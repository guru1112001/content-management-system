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
        Schema::create('syllabi', function (Blueprint $table) {
            $table->id();
            $table->string('Day')->nullable();
            $table->integer('batch_id')->nullable();
            $table->integer('Course_id')->nullable();
            $table->string('Syllabus')->nullable();
            $table->string('SSTA')->nullable();
            $table->integer('User_id')->nullable();
            $table->dateTime('Date')->nullable();
            $table->string('Status')->default('Not Completed');
            $table->text('Comments')->nullable();


            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('syllabuses');
    }
};
