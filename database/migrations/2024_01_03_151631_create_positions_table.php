<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->id();
            $table->string('title_en', 255);
            $table->string('title_kh', 255);
            $table->text('description_kh')->nullable();
            $table->text('description_en')->nullable();
            $table->string('department', 255);
            $table->string('experience', 255);
            $table->string('note', 255)->nullable();
            $table->string('external_url', 255)->nullable();
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
        Schema::dropIfExists('positions');
    }
}