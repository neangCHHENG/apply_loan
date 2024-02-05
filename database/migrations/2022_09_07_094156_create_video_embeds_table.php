<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideoEmbedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_embeds', function (Blueprint $table) {
            $table->id();
            $table->string('title_kh', 100);
            $table->string('title_en', 100);
            $table->string('url', 225);
            $table->text('description_kh')->nullable();
            $table->text('description_en')->nullable();
            $table->boolean('active')->default(0);
            $table->boolean('state')->default(1);
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
        Schema::dropIfExists('video_embeds');
    }
}
