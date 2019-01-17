<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_list', function (Blueprint $table) {
            $table->comment = '分类表';
            $table->charset='utf8mb4';
            $table->collation='utf8mb4_general_ci';
            $table->engine='InnoDB';
            $table->increments('id');
            $table->unsignedInteger('parent_id')->comment('父分类');
            $table->string('category_name')->comment('分类名称');
            $table->string('category_alias')->comment('名称别名');
            $table->text('description')->nullable()->comment('分类描述');
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
        Schema::dropIfExists('category_list');
    }
}
