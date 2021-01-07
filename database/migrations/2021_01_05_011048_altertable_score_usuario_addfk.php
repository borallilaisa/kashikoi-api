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
            $table->foreign('idAluno')->references('id')->on('users');
            $table->foreign('idProfessor')->references('id')->on('users');
            $table->foreign('idConversa')->references('id')->on('conversas');
           
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
            $table->dropForeign(['idAluno']);
            $table->dropForeign(['idProfessor']);
            $table->dropForeign(['idConversa']);
    });
    }
}
