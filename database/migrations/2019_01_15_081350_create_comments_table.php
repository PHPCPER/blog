<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->comment = '评论表';
            $table->charset='utf8mb4';
            $table->collation='utf8mb4_general_ci';
            $table->engine='InnoDB';
            $table->increments('comment_id')->comment('评论ID');
            $table->unsignedInteger('user_id')->comment('发表文章用户id');
            $table->unsignedInteger('article_id')->comment('文章id');
            $table->string('user_name')->comment('评论人昵称');
            $table->unsignedInteger('comment_love_count')->comment('点赞数量');
            $table->longText('comment_content')->comment('评论内容');
            $table->text('parent_comment_id')->nullable()->comment('评论父级');
            $table->unsignedInteger('article_view')->comment('浏览数量');
            $table->unsignedTinyInteger('status')->comment('状态 0禁用 1 启用');
            $table->softDeletes();
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
        Schema::dropIfExists('comments');
    }
}
