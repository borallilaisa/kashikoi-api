<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMensagemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensagems', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->text('corpoMensagem', 1200);
            $table->bigInteger('status');
            $table->bigInteger('idConversa')->unsigned();
            $table->bigInteger('idEmitente')->unsigned();
            $table->bigInteger('idDestinatario')->unsigned();
          
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensagems');
    }
}
