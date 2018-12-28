<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTagPivotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag_pivots', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('post_id')->comment('文章ID');
            $table->unsignedInteger('tag_id')->comment('标签ID');
            $table->unique(['post_id','tag_id'],'idx_post_tag');
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
        Schema::dropIfExists('post_tag_pivots');
    }
}
