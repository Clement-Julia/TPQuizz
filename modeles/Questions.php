<?php

class Question extends Modele {

    private $idQuestion; // int
    private $description; // string
    private $reponses = []; // array

    public function __construct($idQuestion = null){

        if ( $idQuestion !== null){
            
            $requete = $this->getBdd()->prepare("SELECT description FROM questions WHERE idQuestion = ?");
            $requete->execute([$idQuestion]);
            $description = $requete->fetch(PDO::FETCH_ASSOC);

            $requete = $this->getBdd()->prepare("SELECT idReponse FROM reponses_quizz WHERE idQuestion = ?");
            $requete->execute([$idQuestion]);
            $reponsesQuizz = $requete->fetchAll(PDO::FETCH_ASSOC);

            foreach ( $reponsesQuizz as $reponse ) {
                $objetReponse = new Reponse($reponse["idReponse"]);
                $this->reponses[] = $objetReponse;
            }

            $this->idQuestion = $idQuestion;
            $this->description = $description["description"];

        }

    }

    public function initialiserQuestion($idQuestion, $description){
        $this->idQuestion = $idQuestion;
        $this->description = $description;

        $requete = $this->getBdd()->prepare("SELECT idReponse, reponse, vrai FROM reponses_quizz WHERE idQuestion = ?");
        $requete->execute([$idQuestion]);
        $reponsesQuizz = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach($reponsesQuizz as $reponseQuizz){
            $objetReponse = new Reponse();
            $objetReponse->initialiserReponse($reponseQuizz["idReponse"], $reponseQuizz["reponse"], $reponseQuizz["vrai"]);
            $this->reponses[] = $objetReponse;
        }
    }

    public function getIdQuestion(){
        return $this->idQuestion;
    }

    public function getDescription(){
        return $this->description;
    }
    
    public function getReponses(){
        return $this->reponses;
    }

    public function setIdQuestion($idQuestion){
        $this->idQuestion = $idQuestion;
    }

    public function setDescription($description){
        $this->description = $description;
    }

    public function addReponse($reponse){
        $this->reponses[] = $reponse;
    }

    public function removeReponse($idReponse){

        foreach ($this->reponses as $clef => $valeur ) {
            if ( $valeur->getIdReponse() == $idReponse ){

                unset($this->reponses[$clef]);
                
            }
        }

    }

}

// $key = array_search(40489, array_column($userdb, 'uid'));