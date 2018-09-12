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
            $table->string('pseudo')->unique();
            $table->string('nom')->nullable();
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->date('date_naissance');
            $table->string('description')->nullable();
            $table->double('note_eval', 2, 1)->nullable();
            $table->enum('role', ['user', 'gerant'])->default('user');
            $table->boolean('active')->default(true);
            $table->boolean('signale')->default(false);
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
