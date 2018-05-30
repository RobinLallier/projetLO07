<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 16/05/2018
 * Time: 18:31
 */

class Disponibilite
{
    private $idnounou;
    private $jour;
    private $heureDebut;
    private $heureFin;
    private $reccurent;
    private $date;

    /**
     * disponibilite constructor.
     * @param $idnounou
     * @param $jour
     * @param $heureDebut
     * @param $heureFin
     */
    public function __construct($idnounou, $jour, $heureDebut, $heureFin)
    {
        $this->idnounou = $idnounou;
        $this->jour = $jour;
        $this->heureDebut = $heureDebut;
        $this->heureFin = $heureFin;
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
    public function getReccurent()
    {
        return $this->reccurent;
    }

    /**
     * @param mixed $reccurent
     */
    public function setReccurent($reccurent)
    {
        $this->reccurent = $reccurent;
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