<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAvisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avis', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_utilisateur')->unsigned();
            $table->integer('id_habitat')->unsigned();
            $table->integer('note');
            $table->string('comment');
            $table->foreign('id_utilisateur')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_habitat')->references('id')->on('habitats')->onDelete('cascade');
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
        Schema::table('avis', function(Blueprint $table) {
            $table->dropForeign('avis_id_utilisateur_foreign');
        });

        Schema::table('avis', function(Blueprint $table) {
            $table->dropForeign('avis_id_habitat_foreign');
        });

        Schema::dropIfExists('avis');
    }
}
