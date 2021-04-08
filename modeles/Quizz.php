<?php

class Quizz extends Modele {

    private $infoQuizz;

    public function __construct($GET_idQuizz)
    {

        $requete = $this->getBdd()->prepare("SELECT idQuizz, titre, libelle, idQuestion, idUtilisateur, description, idReponse, reponse FROM quizz LEFT JOIN questions USING(idQuizz) LEFT JOIN reponses_quizz USING(idQuestion) LEFT JOIN categories USING(idCategorie) WHERE idQuizz = ?");
        $requete->execute([$GET_idQuizz]); 
        
        $this->infoQuizz = $this->getFormattingInfoQuizz($requete->fetchAll(PDO::FETCH_ASSOC));

    }

    private function getFormattingInfoQuizz($requete){

        $indexNewArray = 0;
        $temp = 0;
        $indexDonneesTriees = 0;
        $doneesTriees = [];

        while($temp < 40){

            if($temp == 0 || $temp % 4 == 0){
                $doneesTriees[$indexDonneesTriees] = [
                    'idQuizz' => $requete[$indexNewArray]['idQuizz'],
                    'titre' => $requete[$indexNewArray]['titre'],
                    'libelle' => $requete[$indexNewArray]['libelle'],
                    'idQuestion' => $requete[$indexNewArray]['idQuestion'],
                    'idUtilisateur' => $requete[$indexNewArray]['idUtilisateur'],
                    'description' => $requete[$indexNewArray]['description']
                ];
                $indexDonneesTriees = $indexDonneesTriees + 1;
            }
            
            $doneesTriees[($indexDonneesTriees - 1)]['reponses'][] = $requete[$temp]['reponse'];

            $temp = $temp + 1;
            if($temp != 0 && $temp % 4 == 0){
                $indexNewArray = $indexNewArray + 4;
            }

        }

    return $doneesTriees;

    }

    public function getInfoQuizz()
    {
        return $this->infoQuizz;
    }

}