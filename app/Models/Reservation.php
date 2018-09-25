<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

use App\Models\Habitat;
use DateTime;
use DateInterval;

class Reservation extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'id_locataire', 'id_proprietaire', 'id_habitat', 'date_debut', 'date_fin', 'montant',

    ];


    /**
     * Récupère toutes les réservations entre 2 dates
     * @param int $user
     * @param DateTime $start
     * @param DateTime $end
     * @return array
     */
    public function getReservBetween(int $user, DateTime $start, DateTime $end) {
        
        $reservations = Reservation::
        whereRaw("((id_locataire = " .$user. " OR id_proprietaire = ".$user.") AND (date_fin <= " .$end->format('Y-m-d') . " OR date_debut >= " .$start->format('Y-m-d'). "))")
        ->get();
    
        return $reservations; 
    }


    /**
     * Récupère toutes les réservations entre 2 dates indexé par jour par user
     * @param int $user
     * @param DateTime $start
     * @param DateTime $end
     * @return array
     */
    public function getReservBetweenByDayByUser(int $user, DateTime $start, DateTime $end) {
        $reservations = $this->getReservBetween($user, $start, $end);

        $days = []; 

        foreach ($reservations as $event) {
            $interval = (new DateTime($event->date_debut))->diff(new DateTime($event->date_fin));
            $nbjour = $interval->format('%d');

            $tabjour = []; 

            for ($i=0; $i < $nbjour; $i++ ) { 
                $date = new DateTime($event->date_debut);
                $date->add(new DateInterval('P'.$i.'D')); 
                array_push($tabjour, $date->format('Y-m-d'));   
            }

            for ($i=0 ; $i < count($tabjour); $i++) {

                if (!isset($days[$tabjour[$i]])) {
                    $days[$tabjour[$i]] = [$event]; 
                } else {
                    $days[$tabjour[$i]][] = $event;
                } 
                
            }
        }

        return $days;
    }


    /**
     * Récupère toutes les réservations pour un habitat indexé par jour 
     * @param  Habitat $habitat
     * @return 
     */
    public function getReservByDayByHabitat(Habitat $habitat) {
        $reservations = Reservation::where('id_habitat', $habitat->id)->get();

        $days = []; 

        // On boucle sur les réservations de l'habitat pour spécifier les dates non disponibles
        foreach ($reservations as $event) {
            $interval = (new DateTime($event->date_debut))->diff(new DateTime($event->date_fin));
            $nbjour = $interval->format('%d');

            $tabjour = []; 

            for ($i=0; $i < $nbjour; $i++ ) { 
                $date = new DateTime($event->date_debut);
                $date->add(new DateInterval('P'.$i.'D')); 
                array_push($tabjour, $date->format('Y-m-d'));   
            }

            for ($i=0 ; $i < count($tabjour); $i++) {

                if (!isset($days[$tabjour[$i]])) {
                    $days[$tabjour[$i]] = ['nondispo']; 
                }   
            }
        }

        // On récupère maintenant toutes les dates libres entre la début et la fin de la disponibilité de l'habitat
        $interval = (new DateTime($habitat->date_debut_dispo))->diff(new DateTime($habitat->date_fin_dispo));
        $nbjour = $interval->format('%a');

        $tabjour = []; 

            for ($i=0; $i < $nbjour; $i++ ) { 
                $date = new DateTime($habitat->date_debut_dispo);
                $date->add(new DateInterval('P'.$i.'D')); 
                array_push($tabjour, $date->format('Y-m-d'));   
            }

            for ($i=0 ; $i < count($tabjour); $i++) {

                if (!isset($days[$tabjour[$i]])) {
                    $days[$tabjour[$i]] = ['dispo']; 
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

        $date = date_create('now')->format('Y-m-d');

    	//$reservation = Reservation::where('id_locataire', $id_locataire)->get();

        // $reservPassee = Reservation::
        //                 join('users', 'reservations.id_locataire', '=', 'users.id')
        //                 ->join('habitats', 'reservations.id_habitat', '=', 'habitats.id')
        //                 ->select('users.*','habitats.*','reservations.*')
        //                 ->where('reservations.date_fin','>', date_create('now')->format('Y-m-d'))
        //                 ->where('reservations.id_locataire','=',$id_locataire)
        //                 ->get();

        $reservPassee = Reservation::where('id_locataire', $id_locataire)
                                    ->where('date_fin', '<', $date)
                                    ->get();

        //dd($reservPassee);

        return $reservPassee;
    }


    /**
     * Return les locations passées en fonction d'un utisateur
     */
    public function getReservationEnCours($id_locataire) {

        $date = date_create('now')->format('Y-m-d');

        $reservEnCours = Reservation::where('id_locataire', $id_locataire)
                                    ->where('date_debut', '<=', $date)
                                    ->where('date_fin', '>=', $date)
                                    ->get();

        return $reservEnCours;
    }


     /**
     * Return les locations passées en fonction d'un utisateur
     */
    public function getReservationFuture($id_locataire) {

        //$reservation = Reservation::where('id_locataire', $id_locataire)->get();
        $date = date_create('now')->format('Y-m-d');

        // $reservFuture = DB::table('reservations')
        //                 ->join('users', 'reservations.id_locataire', '=', 'users.id')
        //                 ->join('habitats', 'reservations.id_habitat', '=', 'habitats.id')
        //                 ->select('users.*','habitats.*','reservations.*')
        //                 ->where('reservations.date_debut','<', date_create('now')->format('Y-m-d'))
        //                 ->where('reservations.id_locataire','=',$id_locataire)
        //                 ->get();

        $reservFuture = Reservation::where('id_locataire', $id_locataire)
                                    ->where('date_debut', '>', $date)
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

      // $reservations =  DB::table('reservations')
      //                   ->join('habitats', 'reservations.id_habitat', '=', 'habitats.id')
      //                   ->join('users','habitats.id_proprietaire','=','users.id')
      //                   ->select('reservations.*', 'habitats.*','users.*')
      //                   ->where('habitats.id_proprietaire', '=', $id_proprietaire)
      //                   ->get();
        
        $reservations =  Reservation::where('id_proprietaire', $id_proprietaire)->get();             

        return $reservations;

        dd($reservations);
    }


}