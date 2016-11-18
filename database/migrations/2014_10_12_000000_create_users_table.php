<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('state_id')->unsigned();
            $table->string('username');
            $table->string('password');
            $table->integer('score')->default(0);
            $table->string('lastActivePlatform');
            $table->boolean('mute')->default(false);
            $table->integer('language_id')->unsigned();
            $table->timestamps();

            $table->foreign('state_id')->references('id')->on('states');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
