<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('title_en', 255);
            $table->string('title_kh', 255);
            $table->string('note', 255)->nullable();
            $table->string('department', 255)->nullable();
            $table->string('external_url', 255)->nullable();
            $table->string('facebook_url', 255)->nullable();
            $table->string('thumbnail', 225)->nullable();
            $table->string('description_en', 255)->nullable();
            $table->string('description_kh', 225)->nullable();
            $table->boolean('state')->default(1);
            $table->string('create_by', 255);
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
        Schema::dropIfExists('companies');
    }
}
