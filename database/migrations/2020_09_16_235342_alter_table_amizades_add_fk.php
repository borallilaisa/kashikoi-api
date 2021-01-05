<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAmizadesAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amizades', function(Blueprint $table){
            $table->foreign('usuario_aluno')->references('id')->on('users');
            $table->foreign('usuario_professor')->references('id')->on('users');
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
            $table->dropForeign(['usuario_aluno']);
            $table->dropForeign(['usuario_professor']);
    });
        
    }
}
