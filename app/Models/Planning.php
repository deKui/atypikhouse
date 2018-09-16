<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Planning extends Model
{
    public $days = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    public $month;
    public $year;

    /**
     * Planning constructor
     * @param int $month Mois compris entre 1 et 12
     * @param int $year Année
     */
    public function __construct(?int $month = null, ?int $year = null) {
    	
    	if ($month === null || $month < 1 || $month > 12) {
    		$month = intval(date('m'));
    	}

    	if ($year === null) {
    		$year = intval(date('Y'));
    	}

    	$this->month = $month;
    	$this->year = $year;
    }


    /**
     * Retourne le mois en toute lettre (ex: Mars 2018)
     * @return string
     */
    public function toString() {
    	return $this->months[$this->month - 1] . ' ' . $this->year;
    }


    /**
     * Retourne le premier jour du mois
     * @return DateTime
     */
    public function getStartingDay() {
        return new DateTime($this->year . '-' . $this->month . '-' . 01);
    }


    /**
     * Retourne le nombre de semaines dans le mois
     * @return int
     */
    public function getWeeks() {
        $start = $this->getStartingDay();
        $end = (clone $start)->modify('+1 month -1 day');

        $startweek = intval($start->format('W'));
        $endweek = intval($end->format('W'));

        if ($endweek === 1) {
            $endweek = intval((clone $end)->modify('- 7 days')->format('W')) + 1;
        }
        
        $weeks = $endweek - $startweek + 1;

        if ($weeks < 0) {
            $weeks = intval($end->format('W'));    
        }

        return $weeks;
    }


    /**
     * Est ce que le jour est dans le mois en cours
     * @param DateTime $date
     * @return bool
     */
    public function withinMonth(DateTime $date) {
        return $this->getStartingDay()->format('Y-m') === $date->format('Y-m');
    }


    /**
     * Renvoie le mois suivant
     * @return Planning
     */
    public function nextMonth() {
        $month = $this->month + 1;
        $year = $this->year;

        if ($month > 12) {
            $month = 1;
            $year += 1;
        }

        return new Planning($month, $year);
    }


    /**
     * Renvoie le mois précédent
     * @return Planning
     */
    public function previousMonth() {
        $month = $this->month - 1;
        $year = $this->year;

        if ($month < 1) {
            $month = 12;
            $year -= 1;
        }

        return new Planning($month, $year);
    }
}
