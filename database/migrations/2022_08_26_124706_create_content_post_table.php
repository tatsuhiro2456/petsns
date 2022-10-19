<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentPostTable extends Migration
{
    public function up()
    {
        Schema::create('content_post', function (Blueprint $table) {
            $table->BigInteger('post_id')->unsigned();
            $table->BigInteger('content_id')->unsigned();
            $table->primary(['content_id', 'post_id']);

        });
    }

    public function down()
    {
        Schema::dropIfExists('content_post');
    }
}
