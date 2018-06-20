<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 16/05/2018
 * Time: 12:47
 */


define('TABLENOUNOU', 'NOUNOU');

class Nounou
{
    private $idNounou;
    private $photo;
    private $age;
    private $experience;
    private $description;

    private $revenu;
    private $candidature;
    private $blocage;

    /**
     * Nounou constructor.
     * @param $idNounou
     * @param $photo
     * @param $age
     * @param $experience
     * @param $description
     */
    public function __construct($idNounou, $photo, $age, $experience, $description)
    {
        $this->idNounou = $idNounou;
        $this->photo = $photo;
        $this->age = $age;
        $this->experience = $experience;
        $this->description = $description;
    }


    public function toSQLString(){
        $string = "(idNounou, lien_photo, age, annees_experience, presentation) 
        VALUES ('".$this->getIdNounou().
            "', '".$this->getPhoto().
            "', '".$this->getAge().
            "', '".$this->getExperience().
            "', '".$this->getDescription()."')";

        return $string;
    }

    public function addToDatabase($bdd){
        require_once ("biblioSQL.php");
        $SQLstring = $this->toSQLString();
        biblioSQL::insertIntoTable($bdd, TABLENOUNOU, $SQLstring);

    }


    /**
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
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
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * @param mixed $ville
     */
    public function setVille($ville)
    {
        $this->ville = $ville;
    }

    /**
     * @return mixed
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * @param mixed $photo
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param mixed $experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getIdNounou()
    {
        return $this->idNounou;
    }

    /**
     * @param mixed $idNounou
     */
    public function setIdNounou($idNounou)
    {
        $this->idNounou = $idNounou;
    }

    /**
     * @return mixed
     */
    public function getRevenu()
    {
        return $this->revenu;
    }

    /**
     * @param mixed $revenu
     */
    public function setRevenu($revenu)
    {
        $this->revenu = $revenu;
    }

    /**
     * @return mixed
     */
    public function getCandidature()
    {
        return $this->candidature;
    }

    /**
     * @param mixed $candidature
     */
    public function setCandidature($candidature)
    {
        $this->candidature = $candidature;
    }

    /**
     * @return mixed
     */
    public function getBlocage()
    {
        return $this->blocage;
    }

    /**
     * @param mixed $blocage
     */
    public function setBlocage($blocage)
    {
        $this->blocage = $blocage;
    }

}