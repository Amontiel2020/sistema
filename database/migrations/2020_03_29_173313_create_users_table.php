<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('last_name',100)->nullable();
            $table->string('email',50)->unique();
            $table->string('user',50)->unique()->nullable();
            $table->string('password',60);
            $table->enum('type',['user','admin','guest'])->nullable();;
            $table->string('active')->nullable();;
            $table->text('address')->nullable();;
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
