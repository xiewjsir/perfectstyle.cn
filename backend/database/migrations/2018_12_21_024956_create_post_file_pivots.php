<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostFilePivots extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_file_pivots', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id')->comment('文章ID');
            $table->unsignedInteger('file_id')->comment('文件ID');
            $table->string('type')->default('normal')->comment('文件ID');//cover
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->unique(['post_id','file_id'],'idx_post_file');
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
        Schema::dropIfExists('post_file_relation');
    }
}
