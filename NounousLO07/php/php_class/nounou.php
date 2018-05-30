<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 16/05/2018
 * Time: 12:47
 */

class Nounou
{
    private $nom;
    private $prenom;
    private $ville;
    private $mail;
    private $tel;
    private $photo;
    private $age;
    private $experience;
    private $description;

    /**
     * nounou constructor.
     * @param $nom
     * @param $prenom
     * @param $ville
     * @param $mail
     * @param $tel
     * @param $photo
     * @param $age
     * @param $experience
     * @param $description
     */
    public function __construct($nom, $prenom, $ville, $mail, $tel, $photo, $age, $experience, $description)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->ville = $ville;
        $this->mail = $mail;
        $this->tel = $tel;
        $this->photo = $photo;
        $this->age = $age;
        $this->experience = $experience;
        $this->description = $description;
    }

    public function toSQLString($idUser){
        $string = "(idNounou, lien_photo, age, annee_experience, presentation) 
        VALUES ($idUser, '".$this->getPhoto()."', '".$this->getAge()."', '".$this->getExperience()
        ."', '".$this->getDescription()."')";

        return $string;
    }

    public function addToDatabase(){
        include "../config.php";
        biblioSQL::insertIntoTable($bdd, nounou, this->toSQLString())
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

}