<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->timestamp('lido_em')->nullable();
            $table->bigInteger('id_amigo')->unsigned()->nullable();
            $table->integer('tipo');
            $table->string('titulo');
            $table->text('mensagem');
            $table->softDeletes();
            $table->bigInteger('id_destinatario')->unsigned();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
