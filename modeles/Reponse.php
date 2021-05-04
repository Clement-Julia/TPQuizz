<?php

class Reponse extends Modele {

    private $idReponse;
    private $reponse;
    private $vrai;

    public function __construct($idReponse = null){

        if ( $idReponse !== null){

            $requete = $this->getBdd()->prepare("SELECT reponse, vrai FROM reponses_quizz WHERE idReponse = ?");
            $requete->execute([$idReponse]);
            $reponse = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idReponse = $idReponse;
            $this->reponse = $reponse["reponse"];
            $this->vrai = $reponse["vrai"];

        }

    }

    public function initialiserReponse($idReponse, $reponse, $vrai){

        $this->idReponse = $idReponse;
        $this->reponse = $reponse;
        $this->vrai = $vrai;
        
    }

    public function creerReponse($reponse, $vrai, $idQuestion){

        $requete = $this->getBdd()->prepare("INSERT INTO reponses_quizz(reponse, vrai, idQuestion) VALUES ( ?, ?, ? )");
        $requete->execute([$reponse, $vrai, $idQuestion]);

    }
    
    public function modifReponse($reponse, $idReponse){

        $requete = $this->getBdd()->prepare("UPDATE reponses_quizz set reponse = ? where idReponse   = ?");
        $requete->execute([$reponse, $idReponse]);

    }
    
    public function getIdReponse(){
        return $this->idReponse;
    }

    public function getReponse(){
        return $this->reponse;
    
    }
    public function getVrai(){
        return $this->vrai;
    }

    public function setIdReponse($idReponse){
        $this->idReponse = $idReponse;
    }

    public function setReponse($reponse){
        $this->reponse = $reponse;
        $update = $this->getBdd()->prepare("UPDATE reponses_quizz SET reponse = ? WHERE idReponse = ?");
        $update->execute([$reponse, $this->getIdReponse()]);
    }

    public function setVrai($vrai){
        $this->vrai = $vrai;
        $update = $this->getBdd()->prepare("UPDATE reponses_quizz SET vrai = ? WHERE idReponse = ?");
        $update->execute([$vrai, $this->getIdReponse()]);
    }

}