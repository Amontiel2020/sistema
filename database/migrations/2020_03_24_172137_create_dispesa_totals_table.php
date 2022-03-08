<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDispesaTotalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispesa_totals', function (Blueprint $table) {
            $table->increments('id');
            $table->string('mes');
            $table->string('ano');
            $table->decimal('valor',5,2);
            $table->decimal('valorDistribuido',5,2)->nullable();

            
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
        Schema::dropIfExists('dispesa_totals');
    }
}
