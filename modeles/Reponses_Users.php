<?php

// les setters non sont pas fait pour le moment

class Reponses_User extends Modele {

    private $idUtilisateur;
    private $idReponse;
    private $idQuestion;

    public function initialiserReponsesUsers($idUtilisateur, $idReponse, $idQuestion){

        $this->idUtilisateur = $idUtilisateur;
        $this->idReponse = $idReponse;
        $this->idQuestion = $idQuestion;

    }

    public function getIdUtilisateur(){
        return $this->idUtilisateur;
    }

    public function getIdReponse(){
        return $this->idReponse;
    }

    public function getIdQuestion(){
        return $this->idQuestion;
    }

    public function getInsertValueBddResultatQuizz($valeurs){

        $str = "INSERT INTO reponses_users(idUtilisateur, idReponse, idQuestion) VALUES " . substr(str_repeat('(?,?,?),', count($valeurs) / 3), 0, -1);; 

        $requete = $this->getBdd()->prepare($str);
        $requete->execute($valeurs);

    }

}