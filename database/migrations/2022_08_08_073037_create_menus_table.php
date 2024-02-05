<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('menu_kh', 100);
            $table->string('menu_en', 100);
            $table->string('slug', 100)->unique();
            $table->string('menu_type', 100)->nullable();
            $table->string('type', 100);
            $table->string('position', 100)->nullable();
            $table->text('link')->nullable();
            $table->integer('left')->default(0);
            $table->integer('right')->default(0);
            $table->integer('is_root')->default(0);
            $table->integer('level')->default(0);
            $table->integer('reference_id')->nullable();
            $table->text('param1')->nullable();
            $table->string('param2', 45)->nullable();
            $table->string('created_by', 45)->nullable();
            $table->string('updated_by', 45)->nullable();
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
        Schema::dropIfExists('menus');
    }
}
