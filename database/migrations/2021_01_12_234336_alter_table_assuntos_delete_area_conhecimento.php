<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAssuntosDeleteAreaConhecimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assuntos', function (Blueprint $table){

            $table->dropForeign(['idAreaDeConhecimento']);
            $table->dropColumn('idAreaDeConhecimento');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assuntos', function(Blueprint $table){

            $table->bigInteger('idAreaDeConhecimento')->unsigned();
            $table->foreign('idAreaDeConhecimento')->references('id')->on('area_de_conhecimentos');
        });
    }
}
