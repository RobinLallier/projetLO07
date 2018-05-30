<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 16/05/2018
 * Time: 18:24
 */

class Parents
{
    private $idparent;
    private $nom;
    private $ville;
    private $email;
    private $info;

    /**
     * parents constructor.
     * @param $idparent
     * @param $nom
     * @param $ville
     * @param $email
     * @param $info
     */
    public function __construct($idparent, $nom, $ville, $email, $info)
    {
        $this->idparent = $idparent;
        $this->nom = $nom;
        $this->ville = $ville;
        $this->email = $email;
        $this->info = $info;
    }

    /**
     * @return mixed
     */
    public function getIdparent()
    {
        return $this->idparent;
    }

    /**
     * @param mixed $idparent
     */
    public function setIdparent($idparent)
    {
        $this->idparent = $idparent;
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
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * @param mixed $info
     */
    public function setInfo($info)
    {
        $this->info = $info;
    }


}