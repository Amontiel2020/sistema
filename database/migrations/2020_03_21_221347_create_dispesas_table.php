<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispesasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispesas', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('valor',5,2);
            $table->string('mes');
            $table->string('ano');
            $table->integer('departamento_id')->unsigned();




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
        Schema::dropIfExists('dispesas');
    }
}
