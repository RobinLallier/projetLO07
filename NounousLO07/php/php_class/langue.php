<?php

define('TABLELANGUE', 'LANGUES');
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 16/05/2018
 * Time: 18:22
 */
class Langue
{
    private $idnounou;
    private $langue;

    /**
     * langue constructor.
     * @param $idnounou
     * @param $langue
     */
    public function __construct($idnounou, $langue)
    {
        $this->idnounou = $idnounou;
        $this->langue = $langue;
    }

    public function toSQLString()
    {
        $string = "(idNounou, langue) 
        VALUES ('" . $this->getIdnounou() .
            "', '" . $this->getLangue() .
            "')";

        return $string;
    }

    public function addToDatabase($bdd)
    {
        require_once("biblioSQL.php");
        $SQLstring = $this->toSQLString();
        biblioSQL::insertIntoTable($bdd, TABLELANGUE, $SQLstring);
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
    public function getLangue()
    {
        return $this->langue;
    }

    /**
     * @param mixed $langue
     */
    public function setLangue($langue)
    {
        $this->langue = $langue;
    }


}