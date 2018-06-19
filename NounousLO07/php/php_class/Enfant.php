<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 19/06/2018
 * Time: 14:44
 */

define('TABLEENFANT', 'ENFANT');
class Enfant
{

    private $idParent;
    private $prenom;
    private $date_naissance;
    private $restrictions_alim;

    /**
     * Enfant constructor.
     * @param $idParent
     * @param $prenom
     * @param $date_naissance
     * @param $restrictions_alim
     */
    public function __construct($idParent, $prenom, $date_naissance, $restrictions_alim)
    {
        $this->idParent = $idParent;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->restrictions_alim = $restrictions_alim;
    }

    public function toSQLString(){
        $string = "(idParents, prenom, date_naissance, restrictions_alim) 
        VALUES ('".$this->getIdParent().
            "', '".$this->getPrenom().
            "', '".$this->getDateNaissance().
            "', '".$this->getRestrictionsAlim().
            "')";

        return $string;
    }

    public function addToDatabase($bdd){
        require_once ("biblioSQL.php");
        $SQLstring = $this->toSQLString();
        biblioSQL::insertIntoTable($bdd, TABLEENFANT, $SQLstring);

    }


    /**
     * @return mixed
     */
    public function getIdParent()
    {
        return $this->idParent;
    }

    /**
     * @param mixed $idParent
     */
    public function setIdParent($idParent)
    {
        $this->idParent = $idParent;
    }

    /**
     * @return mixed
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return mixed
     */
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * @param mixed $date_naissance
     */
    public function setDateNaissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;
    }

    /**
     * @return mixed
     */
    public function getRestrictionsAlim()
    {
        return $this->restrictions_alim;
    }

    /**
     * @param mixed $restrictions_alim
     */
    public function setRestrictionsAlim($restrictions_alim)
    {
        $this->restrictions_alim = $restrictions_alim;
    }
}