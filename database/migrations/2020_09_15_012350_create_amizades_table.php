<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmizadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amizades', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->bigInteger('usuario_aluno')->unsigned();
            $table->bigInteger('usuario_professor')->unsigned();
            $table->boolean('ativa')->default(true);
            $table->boolean('bloqueio')->default(true);
            $table->timestamp('data_inicio')->nullable();

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amizades');
    }
}
