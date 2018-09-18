<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_locataire')->unsigned();
            $table->integer('id_habitat')->unsigned();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->float('montant');
            $table->string('statut');
            $table->foreign('id_locataire')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('reservations', function(Blueprint $table) {
            $table->dropForeign('reservations_id_locataire_foreign');
        });

        Schema::table('reservations', function(Blueprint $table) {
            $table->dropForeign('reservations_id_habitat_foreign');
        });

        Schema::dropIfExists('reservations');
    }
}
