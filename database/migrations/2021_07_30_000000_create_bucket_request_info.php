<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBucketRequestInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bucket_request_info', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ip', 30)->default(' ');
            $table->string('imei')->default(' ');
            $table->string('client', 10)->default(' ');
            $table->string('fullUrl')->default(' ');
            $table->string('api')->default(' ');
            $table->string('method', 10)->default(' ');
            $table->timestamp('timeIn')->default(' ');
            $table->timestamp('timeOut')->default(' ');
            $table->smallInteger('timeUsed')->default(0);
            $table->json('response')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bucket_request_info');
    }
}
