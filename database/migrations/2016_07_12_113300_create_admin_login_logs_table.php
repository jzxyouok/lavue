<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminLoginLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_login_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('admin_id')->comment('用户ID')->index();
            $table->string('username')->comment('用户名');
            $table->ipAddress('ip')->comment('ip地址');
            $table->tinyInteger('status')->comment('状态：1-成功，0失败');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('admin_login_logs');
    }
}
