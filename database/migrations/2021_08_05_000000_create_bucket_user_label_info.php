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
            $table->integer('user_id');
            $table->json('style');
            $table->json('region');
            $table->json('budget');
            $table->string('most_like_style');
            $table->string('most_like_region');
            $table->string('most_like_budget');
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
    }
}
