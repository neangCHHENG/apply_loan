<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title_en', 225);
            $table->string('title_kh', 225);
            $table->string('slug_kh', 225);
            $table->string('slug_en', 225)->unique();
            $table->integer('feature');
            $table->integer('access');
            $table->string('thumbnail', 225)->nullable();
            $table->text('meta_content_kh', 225)->nullable();
            $table->string('meta_keyword_kh', 225)->nullable();
            $table->text('meta_content_en', 225)->nullable();
            $table->string('meta_keyword_en', 225)->nullable();
            $table->text('introduction_en')->nullable();
            $table->text('introduction_kh')->nullable();
            $table->string('note', 225)->nullable();
            $table->string('relate_article')->nullable();
            $table->string('parent_tag_id')->nullable();
            $table->integer('parent_category_id');
            $table->text('article_editor_en');
            $table->text('article_editor_kh');
            $table->integer('ordering');
            $table->string('schedule', 100)->nullable();
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
        Schema::dropIfExists('articles');
    }
}
