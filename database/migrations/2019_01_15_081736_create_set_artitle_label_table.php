<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSetArtitleLabelTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('set_artitle_label', function (Blueprint $table) {
            $table->comment = '文章设置标签表';
            $table->charset='utf8mb4';
            $table->collation='utf8mb4_general_ci';
            $table->engine='InnoDB';
            $table->increments('id');
            $table->unsignedInteger('article_id')->comment('文章id');
            $table->unsignedInteger('label_id')->comment('标签id')->index();
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
        Schema::dropIfExists('set_artitle_label');
    }
}
