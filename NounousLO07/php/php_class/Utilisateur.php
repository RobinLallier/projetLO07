<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 31/05/2018
 * Time: 08:32
 */
define('TABLE', 'UTILISATEURS');
include ("../biblioSQL.php");

class Utilisateur
{
    private $id_utilisateur;
    private $nom;
    private $prenom;
    private $ville;
    private $email;


    /**
     * Utilisateur constructor.
     * @param $id_utilisateur
     * @param $nom
     * @param $prenom
     * @param $ville
     * @param $email
     * @param $telephone
     * @param $login
     * @param $mdp
     */
    public function __construct($nom, $prenom, $ville, $email, $telephone, $login, $mdp)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->ville = $ville;
        $this->email = $email;
        $this->telephone = $telephone;
        $this->login = $login;
        $this->mdp = $mdp;
    }


    public function toSQLString(){
        $string = "(nom, prenom, ville, email, telephone, login, mdp) 
        VALUES ('".$this->getNom()
            ."', '".$this->getPrenom()."', '".$this->getVille()
            ."', '".$this->getEmail()."', '".$this->getTelephone()
            ."', '".$this->getLogin()."', '".$this->getMdp()."')";

        return $string;
    }

    public function addToDatabase($bdd){

        $SQLstring = $this->toSQLString();
        biblioSQL::insertIntoTable($bdd, TABLE, $SQLstring);
}

    /**
     * @return mixed
     */
    public function getIdUtilisateur()
    {
        return $this->id_utilisateur;
    }

    /**
     * @param mixed $id_utilisateur
     */
    public function setIdUtilisateur($id_utilisateur)
    {
        $this->id_utilisateur = $id_utilisateur;
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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * @param mixed $telephone
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getMdp()
    {
        return $this->mdp;
    }

    /**
     * @param mixed $mdp
     */
    public function setMdp($mdp)
    {
        $this->mdp = $mdp;
    }

    /**
     * @return mixed
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * @param mixed $admin
     */
    public function setAdmin($admin)
    {
        $this->admin = $admin;
    }
    private $telephone;
    private $login;
    private $mdp;
    private $admin;




}