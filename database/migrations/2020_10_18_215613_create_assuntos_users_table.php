<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssuntosUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assuntos_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->integer('tipo');
            $table->bigInteger('userID')->unsigned();
            $table->bigInteger('assuntoID')->unsigned();

            

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('assuntos_users');
    }
}
