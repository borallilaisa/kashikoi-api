<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableConversasAddAssuntoFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('conversas', function(Blueprint $table){

            $table->bigInteger('idAssunto')->unsigned();
            $table->foreign('idAssunto')->references('id')->on('assuntos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('conversas', function (Blueprint $table){

            $table->dropForeign(['idAssunto']);
            $table->dropColumn('idAssunto');
        });
    }
}
