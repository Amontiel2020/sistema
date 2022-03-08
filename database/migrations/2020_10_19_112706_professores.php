<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Professores extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professores', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('apelido');
            $table->string('BI');
            $table->string('email');
            $table->string('categoria');
            $table->string('genero');
            $table->string('estado');
            $table->string('telefone1');
            $table->string('telefone2');
            $table->string('endereco');
            $table->string('pathImage');

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
        Schema::dropIfExists('professores');
    }
}
