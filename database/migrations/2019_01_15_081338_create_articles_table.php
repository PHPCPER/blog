<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->comment = '文章表';
            $table->charset='utf8mb4';
            $table->collation='utf8mb4_general_ci';
            $table->engine='InnoDB';
            $table->increments('id');
            $table->unsignedInteger('user_id')->comment('发表文章用户id');
            $table->text('article_title')->comment('文章题目');
            $table->longText('article_content')->comment('文章内容');
            $table->text('article_description')->nullable()->comment('分类描述');
            $table->unsignedInteger('article_view')->comment('浏览数量');
            $table->unsignedInteger('article_comment_count')->comment('评论数量');
            $table->unsignedInteger('article_love_count')->comment('点赞数量');
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
        Schema::dropIfExists('articles');
    }
}
