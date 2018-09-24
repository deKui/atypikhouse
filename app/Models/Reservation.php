<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use DateTime;

class Reservation extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_locataire', 'id_habitat', 'date_debut', 'date_fin', 'montant','statut',
    ];

    /**
     * Récupère toutes les réservations entre 2 dates
     * @param DateTime $start
     * @param DateTime $end
     * @return array
     */
    public function getReservBetween(DateTime $start, DateTime $end) {
        $reservations = Reservation::where('date_debut', '>=', $start)->where('date_fin', '<=', $end)->get();
    
        return $reservations; 
    }


    /**
     * Récupère toutes les réservations entre 2 dates indexé par date de début
     * @param DateTime $start
     * @param DateTime $end
     * @return array
     */
    public function getReservBetweenByStartingDay(DateTime $start, DateTime $end) {
        $reservations = $this->getReservBetween($start, $end);

        $days = []; 

        foreach ($reservations as $event) {
            //$interval = (new DateTime($event->date_debut))->diff(new DateTime($event->date_fin));
            //dd($interval->format('%R%a jours'));

            $date = $event->date_debut;

            if (!isset($days[$date])) {
                $days[$date] = [$event]; 
            } else {
                $days[$date][] = $event;
            }
        }

        return $days;
    }


    /**
     * Récupère toutes les réservations entre 2 dates indexé par date de fin
     * @param DateTime $start
     * @param DateTime $end
     * @return array
     */
    public function getReservBetweenByEndingDay(DateTime $start, DateTime $end) {
        $reservations = $this->getReservBetween($start, $end);

        $days = []; 

        foreach ($reservations as $event) {

            $date = $event->date_fin;

            if (!isset($days[$date])) {
                $days[$date] = [$event]; 
            } else {
                $days[$date][] = $event;
            }
        }

        return $days;
    }


    /**
     * Auteur : Lucas 
     * Joint la table reservations et habitats
     */
    public function habitats()
    {
        return $this->belongsTo(Habitat::class, 'id_habitat');
    }


    /**
     * Auteur : Lucas 
     * Joint la table reservations et users
     */
    public function users()
    {
        return $this->belongsTo(User::class, 'id_locataire');
    }


	 /**
     * Return les locations passées en fonction d'un utisateur
     */
    public function getReservationPassee($id_locataire) {

    	//$reservation = Reservation::where('id_locataire', $id_locataire)->get();

        $reservPassee = Reservation::
                        join('users', 'reservations.id_locataire', '=', 'users.id')
                        ->join('habitats', 'reservations.id_habitat', '=', 'habitats.id')
                        ->select('users.*','habitats.*','reservations.*')
                        ->where('reservations.date_fin','>', date_create('now')->format('Y-m-d'))
                        ->where('reservations.id_locataire','=',$id_locataire)
                        ->get();
        return $reservPassee;
    }

     /**
     * Return les locations passées en fonction d'un utisateur
     */
    public function getReservationFuture($id_locataire) {

        //$reservation = Reservation::where('id_locataire', $id_locataire)->get();

        $reservFuture = DB::table('reservations')
                        ->join('users', 'reservations.id_locataire', '=', 'users.id')
                        ->join('habitats', 'reservations.id_habitat', '=', 'habitats.id')
                        ->select('users.*','habitats.*','reservations.*')
                        ->where('reservations.date_debut','<', date_create('now')->format('Y-m-d'))
                        ->where('reservations.id_locataire','=',$id_locataire)
                        ->get();

        return $reservFuture;
    }




    /**
     * Auteur : Valériane
     * Retourne les avis signalés
    */
    public function getAvisSignale()
    {
        //$avisSignale = Avis::where('signale', true)->get();


      $avisSignale =  DB::table('avis')
                        ->join('users', 'avis.id_utilisateur', '=', 'users.id')
                        ->join('habitats', 'avis.id_habitat', '=', 'habitats.id')
                        ->select('users.id','habitats.id','users.pseudo', 'habitats.titre', 'avis.*')
                        ->where('avis.signale', true)
                        ->get();

        return $avisSignale;
    }

    /**
     * Auteur : Valériane
     * Retourne les demandes de réservations 
    */
    public function getReservationProprio($id_proprietaire)
    {

      $reservations =  DB::table('reservations')
                        ->join('habitats', 'reservations.id_habitat', '=', 'habitats.id')
                        ->join('users','habitats.id_proprietaire','=','users.id')
                        ->select('reservations.*', 'habitats.*','users.*')
                        ->where('habitats.id_proprietaire', '=', $id_proprietaire)
                        ->get();

        return $reservations;

        dd($reservations);
    }


}