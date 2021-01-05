<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableDenunciasAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('denuncias', function (Blueprint $table){
         $table->foreign('usuarioDenunciador')->references('id')->on('users');
         $table->foreign('usuarioDenunciado')->references('id')->on('users');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('denuncias', function (Blueprint $table){
         $table->dropForeign(['usuarioDenunciador']);
         $table->dropForeign(['usuarioDenunciado']);
        });
    }
}
