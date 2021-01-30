<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltertableScoreUsuarioAddfk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('score_usuario', function (Blueprint $table){
            $table->foreign('idDestinatario')->references('id')->on('users');
            $table->foreign('idRemetente')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('score_usuario', function (Blueprint $table){
            $table->dropForeign(['idDestinatario']);
            $table->dropForeign(['idRemetente']);
    });
    }
}
