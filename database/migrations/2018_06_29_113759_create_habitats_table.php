<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHabitatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habitats', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_proprietaire')->unsigned();
            $table->integer('id_type_habitat')->unsigned();
            $table->string('titre');
            $table->string('description');
            $table->string('photo');
            $table->string('adresse');
            $table->integer('code_postal');
            $table->string('ville');
            $table->integer('nb_lit_simple');
            $table->integer('nb_lit_double');
            $table->integer('nb_personne_max');
            $table->date('date_debut_dispo');
            $table->date('date_fin_dispo');
            $table->integer('prix');
            $table->boolean('signale')->default(false);
            $table->foreign('id_proprietaire')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_type_habitat')->references('id')->on('type_habitats')->onDelete('cascade');
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
        Schema::table('habitats', function(Blueprint $table) {
            $table->dropForeign('habitats_id_proprietaire_foreign');
        });

        Schema::table('habitats', function(Blueprint $table) {
            $table->dropForeign('habitats_id_type_habitat_foreign');
        });

        Schema::dropIfExists('habitats');
    }
}
