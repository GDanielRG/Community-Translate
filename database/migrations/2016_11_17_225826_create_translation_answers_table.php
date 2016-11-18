<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslationAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translation_answers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('translation_petition_id')->unsigned();
            $table->string('translation');
            $table->timestamps();

            $table->foreign('translation_petition_id')->references('id')->on('translation_petitions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translation_answers');
    }
}
