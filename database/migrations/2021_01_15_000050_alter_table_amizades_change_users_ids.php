<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAmizadesChangeUsersIds extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amizades', function(Blueprint $table){
            $table->dropForeign(['usuario_aluno']);
            $table->dropForeign(['usuario_professor']);

            $table->dropColumn(['usuario_aluno']);
            $table->dropColumn(['usuario_professor']);

            $table->dropColumn(['data_inicio']);

            $table->bigInteger('id_usuario_1')->unsigned();
            $table->bigInteger('id_usuario_2')->unsigned();

            $table->foreign('id_usuario_1')->references('id')->on('users');
            $table->foreign('id_usuario_2')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amizades', function(Blueprint $table){
            $table->dropForeign(['id_usuario_1']);
            $table->dropForeign(['id_usuario_2']);

            $table->dropColumn(['id_usuario_1']);
            $table->dropColumn(['id_usuario_2']);

            $table->bigInteger('usuario_aluno')->unsigned();
            $table->bigInteger('usuario_professor')->unsigned();

            $table->foreign('usuario_aluno')->references('id')->on('users');
            $table->foreign('usuario_professor')->references('id')->on('users');

            $table->timestamp('data_inicio')->nullable();
        });
    }
}
