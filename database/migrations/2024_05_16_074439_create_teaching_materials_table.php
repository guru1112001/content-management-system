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
        Schema::create('teaching_materials', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('section_id')->nullable();
            $table->string('material_source')->nullable();
            $table->string('file')->nullable();
            $table->text('content')->nullable();
            $table->boolean('unlimited_view')->default(false);
            $table->integer('maximum_views')->nullable();
            $table->string('prerequisite')->nullable();
            $table->text('description')->nullable();
            $table->boolean('privacy_allow_access')->default(false);
            $table->boolean('privacy_downloadable')->default(false);
            $table->boolean('published')->default(true);
            $table->integer('sort')->nullable();
            $table->string('doc_type')->nullable();
            $table->integer('maximum_marks')->nullable();
            $table->decimal('passing_percentage')->nullable();
            $table->string('result_declaration')->nullable();
            $table->integer('maximum_attempts')->nullable();
            $table->text('general_instructions')->nullable();
            $table->dateTime('start_submission')->nullable();
            $table->dateTime('stop_submission')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teaching_materials');
    }
};
