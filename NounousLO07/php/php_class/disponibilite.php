<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 16/05/2018
 * Time: 18:31
 */
include("biblioSQL.php");
define("TABLEDISPO", "DISPONIBILITES");

class Disponibilite
{
    private $idnounou;
    private $jour;
    private $heureDebut;
    private $heureFin;
    private $recurrent;
    private $date;

    /**
     * disponibilite constructor.
     * @param $idnounou
     * @param $jour
     * @param $heureDebut
     * @param $heureFin
     */
    public function __construct(){
        $ctp = func_num_args();
        $args = func_get_args();
        switch($ctp){
            case 4 :
                $this->dispo_ponctu($args[0], $args[1], $args[2], $args[3]);
                break;
            case 5 :
                $this->dispo_recu($args[0], $args[1], $args[2], $args[3], $args[4]);
                break;
            default : break;
        }
    }
    private function dispo_ponctu($idnounou, $date, $heureDebut, $heureFin)
    {
        $this->idnounou = $idnounou;
        $this->date = $date;
        $this->heureDebut = $heureDebut;
        $this->heureFin = $heureFin;
    }

    private function dispo_recu($idnounou, $jour, $heureDebut, $heureFin, $recurrent)
    {
        $this->idnounou = $idnounou;
        $this->jour = $jour;
        $this->heureDebut = $heureDebut;
        $this->heureFin = $heureFin;
        $this->recurrent = $recurrent;
    }

    public function toSQLString($recu){
        if($recu){
            $string = "(idnounou, jour, heure_debut, heure_fin, recurrence) 
        VALUES ('".$this->getIdnounou()
                ."', '".$this->getJour()
                ."', '".$this->getHeureDebut()
                ."', '".$this->getHeureFin()
                ."', '".$this->getRecurrent()."')";

        }
        else{
            $string = "(idnounou, heure_debut, heure_fin, date) 
        VALUES ('".$this->getIdnounou()
                ."', '".$this->getHeureDebut()
                ."', '".$this->getHeureFin()
                ."', '".$this->getDate()."')";
        }
        return $string;
    }


    public function addToDatabase($bdd, $recu){
        if($recu){
            $SQLstring = $this->toSQLString($recu);
            biblioSQL::insertIntoTable($bdd, TABLEDISPO, $SQLstring);
        }
        else{
            $SQLstring = $this->toSQLString(false);
            biblioSQL::insertIntoTable($bdd, TABLEDISPO, $SQLstring);
        }

    }


    /**
     * @return mixed
     */
    public function getIdnounou()
    {
        return $this->idnounou;
    }

    /**
     * @param mixed $idnounou
     */
    public function setIdnounou($idnounou)
    {
        $this->idnounou = $idnounou;
    }

    /**
     * @return mixed
     */
    public function getJour()
    {
        return $this->jour;
    }

    /**
     * @param mixed $jour
     */
    public function setJour($jour)
    {
        $this->jour = $jour;
    }

    /**
     * @return mixed
     */
    public function getHeureDebut()
    {
        return $this->heureDebut;
    }

    /**
     * @param mixed $heureDebut
     */
    public function setHeureDebut($heureDebut)
    {
        $this->heureDebut = $heureDebut;
    }

    /**
     * @return mixed
     */
    public function getHeureFin()
    {
        return $this->heureFin;
    }

    /**
     * @param mixed $heureFin
     */
    public function setHeureFin($heureFin)
    {
        $this->heureFin = $heureFin;
    }

    /**
     * @return mixed
     */
    public function getRecurrent()
    {
        return $this->recurrent;
    }

    /**
     * @param mixed $recurrent
     */
    public function setRecurrent($recurrent)
    {
        $this->recurrent = $recurrent;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}