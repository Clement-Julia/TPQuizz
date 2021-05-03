<?php
// les setters ne sont pas encore fait
class Ami extends Modele {

    private $idUtilisateur1;
    private $idUtilisateur2;
    private $scoresAmi = [];

    public function initialiserAmi($idUtilisateur1, $idUtilisateur2){

        $this->idUtilisateur1 = $idUtilisateur1;
        $this->idUtilisateur2 = $idUtilisateur2;

        $requete = $this->getBdd()->prepare("SELECT * FROM score WHERE idUtilisateur = ? ORDER BY score DESC");
        $requete->execute([$this->getIdUtilisateur2()]);
        $infos = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach ( $infos as $info ){

            $score = new Score();
            $score->initialiserScore($info["idUtilisateur"], $info["idQuizz"], $info["score"]);
            $this->scoresAmi[] = $score;

        }

        $this->scoresAmi;

    }

    public function getIdUtilisateur1(){
        return $this->idUtilisateur1;
    }

    public function getIdUtilisateur2(){
        return $this->idUtilisateur2;
    }

    public function getScores(){
        return $this->scoresAmi;
    }

}