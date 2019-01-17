<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLabelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('labels', function (Blueprint $table) {
            $table->comment = '标签表';
            $table->charset='utf8mb4';
            $table->collation='utf8mb4_general_ci';
            $table->engine='InnoDB';
            $table->increments('id');
            $table->string('category_name')->comment('标签名称');
            $table->string('category_alias')->comment('标签别名');
            $table->text('description')->nullable()->comment('标签描述');
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
        Schema::dropIfExists('labels');
    }
}
