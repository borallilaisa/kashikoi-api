<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableUsuarioPerfilsAdjustFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('usuario_perfils', function ($table) {
            $table->dropColumn('name');
            $table->dropColumn('lastName');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuario_perfils', function ($table) {
            $table->string('name', 12);
            $table->string('lastName', 12);
        });
    }
}
