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
        Schema::create('scans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resume_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id');

            $table->string('job_title')->nullable();
            $table->text('job_description');

            $table->unsignedInteger('score')->default(0);
            $table->unsignedInteger('skills_match')->default(0);
            $table->unsignedInteger('experience_match')->default(0);
            $table->unsignedInteger('education_match')->default(0);
            $table->unsignedInteger('keywords_matched')->default(0);
            $table->unsignedInteger('keywords_total')->default(0);

            $table->json('missing_skills')->nullable();
            $table->json('matched_skills')->nullable();
            $table->json('recommendations')->nullable();

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scans');
    }
};
