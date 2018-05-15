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
            $table->integer('id_utilisateur')->unsigned();
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
            $table->string('prix');
            $table->foreign('id_utilisateur')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_type_habitat')->references('id')->on('type_habitat')->onDelete('cascade');
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
            $table->dropForeign('habitats_id_utilisateur_foreign');
        });

        Schema::table('habitats', function(Blueprint $table) {
            $table->dropForeign('habitats_id_type_habitat_foreign');
        });

        Schema::dropIfExists('habitats');
    }
}
