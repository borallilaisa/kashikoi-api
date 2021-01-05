<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableMensagemsAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('mensagems', function (Blueprint $table){
            $table->foreign('idEmitente')->references('id')->on('users');
            $table->foreign('idDestinatario')->references('id')->on('users');
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
        Schema::table('mensagems', function (Blueprint $table){
            $table->dropForeign(['idDestinatario']);
            $table->dropForeign(['idEmitente']);
            $table->dropForeign(['idConversa']);
           
         });
        
    }
}
