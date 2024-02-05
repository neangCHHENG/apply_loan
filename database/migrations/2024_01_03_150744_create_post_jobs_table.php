<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('post_jobs', function (Blueprint $table) {
            $table->id();
            $table->string('location', 255);
            $table->string('company', 255);
            $table->string('vacancy_type', 255);
            $table->string('position', 255);
            $table->string('note', 255)->nullable();
            $table->string('start_date', 255);
            $table->string('end_date', 255);
            $table->string('create_by', 255);
            $table->string('qualification', 255)->nullable();
            $table->string('offered_salary', 255)->nullable();
            $table->string('language_skills', 255)->nullable();
            $table->string('hiring', 255)->nullable();
            $table->string('career_level', 255)->nullable();
            $table->string('thumbnail', 225)->nullable();
            $table->boolean('state')->default(1);
            $table->integer('urgent');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_jobs');
    }
}
