<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    private $months = ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'];
    private $month;
    private $year;

    /**
     * Month constructor
     * @param int $month Mois compris entre 1 et 12
     * @param int $year Année
     */
    public function __construct(?int $month = null, ?int $year = null) {
    	
    	if ($month === null) {
    		$month = intval(date('m'));
    	}

    	if ($year === null) {
    		$year = intval(date('Y'));
    	}

    	if ($month < 1 || $month > 12) {
    		throw new \Exception("Le mois $month n'est pas valide");
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
}
