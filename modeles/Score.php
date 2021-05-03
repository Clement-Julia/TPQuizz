<?php

// les setters non sont pas fait encore

class Score extends Modele {

    private $idUtilisateur;
    private $idQuizz;
    private $score;

    public function __construct($idUtilisateur = null, $idQuizz = null){

        if ( $idQuizz != null && $idUtilisateur != null ){
    
            $requete = $this->getBdd()->prepare("SELECT * FROM score WHERE idUtilisateur = ? AND idQuizz = ?");
            $requete->execute([$idUtilisateur, $idQuizz]);
            $info = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idUtilisateur = $idUtilisateur;
            $this->idQuizz = $idQuizz;
            $this->score = $info["score"];

        }

    }

    public function getIdUtilisateur(){
        return $this->idUtilisateur;
    }

    public function getIdQuizz(){
        return $this->idQuizz;
    }

    public function getScore(){
        return $this->score;
    }

    public function initialiserScore($idUtilisateur, $idQuizz, $score){

        $this->idUtilisateur = $idUtilisateur;
        $this->idQuizz = $idQuizz;
        $this->score = $score;
        
    }

    public function updateScore($idUtilisateur, $idQuizz, $score){

        $requete = $this->getBdd()->prepare("INSERT INTO score (idUtilisateur, idQuizz, score) VALUES (?,?,?)");
        $requete->execute([$idUtilisateur, $idQuizz, $score]);

    }

}