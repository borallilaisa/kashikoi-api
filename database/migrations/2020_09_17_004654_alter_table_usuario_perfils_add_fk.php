<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsuarioPerfilsAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuario_perfils', function (Blueprint $table){
        $table->foreign('userID')->references('id')->on('users');
    });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_perfils', function (Blueprint $table){
        $table->dropForeign(['userID']);
    });
    }
}
