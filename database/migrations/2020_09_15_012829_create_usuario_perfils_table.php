<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsuarioPerfilsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usuario_perfils', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('userID')->unsigned();
            $table->string('name', 12);
            $table->string('lastName', 12);
            $table->text('textProfile')->nullable();
            $table->string('phone', 20)->nullable();
            $table->integer('score');
            $table->datetime('lastOnline')->nullable();
            $table->string('status')->default(false);
            $table->string('profilePic')->nullable();
            $table->boolean('verified')->default(false);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('usuario_perfils');
    }
}
