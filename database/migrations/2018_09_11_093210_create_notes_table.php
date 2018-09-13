<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('from_id')->unsigned();
            $table->integer('to_id')->unsigned();
            $table->integer('note');
            $table->foreign('from_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('to_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('notes', function(Blueprint $table) {
<<<<<<< HEAD
            $table->dropForeign('avis_from_id_foreign');
        });

        Schema::table('notes', function(Blueprint $table) {
            $table->dropForeign('avis_to_id_foreign');
=======
            $table->dropForeign('notes_from_id_foreign');
        });

        Schema::table('notes', function(Blueprint $table) {
            $table->dropForeign('notes_to_id_foreign');
>>>>>>> c20d4861943c6040d1b798025f7d2398537e4c55
        });

        Schema::dropIfExists('notes');
    }
}
