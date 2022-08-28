<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecruitmentRepliesTable extends Migration
{
    public function up()
    {
        Schema::create('recruitment_replies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('body');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('recruitment_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recruitment_id')->references('id')->on('recruitments')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('recruitment_replies');
    }
}
