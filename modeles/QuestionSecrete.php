<?php

class QuestionSecrete extends Modele {

    private $idQuestionS;
    private $question;
    private $questionAll = [];

    public function __construct($idQuestionS = null){

        if ($idQuestionS != null){

            $requete = $this->getBdd()->prepare("SELECT * FROM question_secrete WHERE idQuestionS = ?");
            $requete->execute([$idQuestionS]);
            $infosQuestionS = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idQuestionS = $infosQuestionS["idQuestionS"];
            $this->question = $infosQuestionS["question"];

        }

    }

    public function getIdQuestion(){
        return $this->idQuestionS;
    }

    public function getQuestion(){
        return $this->question;
    }

    public function setIdQuestion($idQuestionS){
        $this->idQuestionS = $idQuestionS;
    }

    public function setQuestion($question){
        $this->question = $question;
    }

    public function getAllQuestion(){
        $requete = $this->getBdd()->prepare("SELECT * FROM question_secrete");
        $requete->execute();
        $infosQuestionS = $requete->fetchALL(PDO::FETCH_ASSOC);

        foreach($infosQuestionS as $infosQuestion){
            $this->questionAll[] = $infosQuestion["question"];
        }

        return $this->questionAll;
    }
}