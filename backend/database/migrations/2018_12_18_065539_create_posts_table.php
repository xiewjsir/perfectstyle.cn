<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',128)->comment('标题');
            $table->unsignedInteger('author')->comment('作者');
            $table->unsignedSmallInteger('column_id')->comment('栏目');
            $table->string('summary',256)->default('')->comment('摘要');
            $table->text('content')->comment('内容');
            $table->string('post_status')->default('draft')->comment('发布状态');
            $table->string('comment_status')->default('open')->comment('评论状态');
            $table->string('post_password')->default('')->comment('查看密码');
            $table->unsignedInteger('views')->default(0)->comment('浏览量');
            $table->unsignedInteger('sort')->default(0)->comment('排序');
            $table->index('column_id');
            $table->index('title');
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
        Schema::dropIfExists('posts');
    }
}
