<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableAssuntosUsersAddFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('assuntos_users', function (Blueprint $table){
            $table->foreign('userID')->references('id')->on('users');
            $table->foreign('assuntoID')->references('id')->on('assuntos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('assuntos_users', function (Blueprint $table){
            $table->dropForeign(['userID']);
            $table->dropForeign(['assuntoID']);
    });
    }
}
