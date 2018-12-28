<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminMenuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_menus', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->default(0);
            $table->string('type',32)->default('menu')->comment('类型 menu 菜单,function 功能');
            $table->integer('sort')->default(0)->comment('排序');
            $table->string('name', 64);
            $table->string('icon', 64);
            $table->string('method', 64)->default('ANY');
            $table->string('uri', 64)->nullable();
            $table->string('level', 64)->nullable(false)->default(0)->comment('层级 从0开始');
            $table->string('path', 128)->nullable(false)->default(0)->comment('路径 包含自身ID');
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
        Schema::dropIfExists('admin_menu');
    }
}
