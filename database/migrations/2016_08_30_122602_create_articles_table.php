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
            $table->increments('id');
            $table->unsignedInteger('category_id')->comment('分类ID')->index();
            $table->integer('admin_id')->comment('最后更新用户');
            $table->string('title', 32)->comment('标题');
            $table->string('summary')->comment('摘要');
            $table->string('gallery')->comment('缩略图');
            $table->text('content')->comment('内容');
            $table->integer('last_user_id')->comment('最后评论用户ID');
            $table->integer('views')->default(0)->comment('浏览量');
            $table->tinyInteger('status')->comment('状态：1启用，0禁用');
            $table->timestamp('start_time')->nullable()->comment('开始时间');
            $table->timestamp('end_time')->nullable()->comment('结束时间');
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
        Schema::drop('articles');
    }
}
