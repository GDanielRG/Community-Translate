<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('target_language_id')->unsigned();
            $table->integer('source_language_id')->unsigned();
            $table->string('text');
            $table->boolean('answered');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('target_language_id')->references('id')->on('languages');
            $table->foreign('source_language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translation_requests');
    }
}
