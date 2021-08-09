<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBucketUserLabelInfo extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('bucket_user_label_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('imei');
            $table->json('most_like_article_keywords');
            $table->timestamps();
        });

        Schema::create('bucket_user_system_analyze', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->integer('increment_num')->comment('每日新增用户数');
            $table->integer('active_num')->comment('每日活跃用户数');
            $table->integer('app_total_use_time')->comment('每日app打开时长,ms为单位');
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
        Schema::dropIfExists('bucket_user_label_info');
        Schema::dropIfExists('bucket_user_system_analyze');
    }
}
