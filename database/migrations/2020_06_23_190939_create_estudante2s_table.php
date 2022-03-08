<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudante2sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudantes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome');
            $table->string('apelido');
            $table->string('curso');
            $table->string('email');
           // $table->string('img');
            $table->integer('turma_id')->unsigned();
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
        Schema::dropIfExists('estudantes');
    }
}
