<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationPetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation_petitions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('translation_request_id')->unsigned();
            $table->integer('translation_answer_id')->unsigned()->nullable();
            $table->boolean('closed')->default(false);
            $table->boolean('sent')->default(false);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('translation_request_id')->references('id')->on('translation_requests');
            $table->foreign('translation_answer_id')->references('id')->on('translation_answers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translation_petitions');
    }
}
