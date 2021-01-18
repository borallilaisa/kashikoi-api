<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableNotificationsAddFks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table){
            $table->foreign('id_destinatario')->references('id')->on('users');
            $table->foreign('id_amigo')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table){
            $table->dropForeign(['id_destinatario']);
            $table->dropForeign(['id_amigo']);
        });
    }
}
