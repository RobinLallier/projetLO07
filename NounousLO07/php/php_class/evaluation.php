<?php
/**
 * Created by PhpStorm.
 * User: Jarvis
 * Date: 16/05/2018
 * Time: 18:26
 */

class evaluation
{
    private $idnounou;
    private $idparent;
    private $note;
    private $commentaire;

    /**
     * evaluation constructor.
     * @param $idnounou
     * @param $idparent
     * @param $note
     * @param $commentaire
     */
    public function __construct($idnounou, $idparent, $note, $commentaire)
    {
        $this->idnounou = $idnounou;
        $this->idparent = $idparent;
        if($note <= 6 && $note > 0) {
            $this->note = $note;
        }
        $this->commentaire = $commentaire;
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
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * @return mixed
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }

    /**
     * @param mixed $commentaire
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;
    }


}