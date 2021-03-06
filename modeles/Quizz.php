<?php

class Quizz extends Modele {

    private $pseudoCreateur; // string
    private $idQuizz; // int
    private $titre; // string

    private $categorie; // objet
    private $questions = []; // array

    public function __construct($idQuizz = null)
    {
        if($idQuizz !== null){
            $requete = $this->getBdd()->prepare("SELECT pseudo, titre, idCategorie FROM quizz INNER JOIN utilisateurs USING(idUtilisateur) WHERE idQuizz = ?");
            $requete->execute([$idQuizz]);
            $infos = $requete->fetch(PDO::FETCH_ASSOC);

            $requete = $this->getBdd()->prepare("SELECT * FROM questions WHERE idQuizz = ?");
            $requete->execute([$idQuizz]);
            $questions = $requete->fetchAll(PDO::FETCH_ASSOC);

            $this->pseudoCreateur = $infos["pseudo"];
            $this->idQuizz = $idQuizz;
            $this->titre  = $infos["titre"];
            $this->categorie = new Categorie($infos["idCategorie"]);


            // Pour chaque question
            foreach ( $questions as $question ){

                $objetQuestion = new Question();
                $objetQuestion->initialiserQuestion($question["idQuestion"], $question["description"]);
                $this->questions[] = $objetQuestion; 
            }

        }
    }

    public function getPseudoCreateur(){
        return $this->pseudoCreateur;
    }

    public function getIdQuizz(){
        return $this->idQuizz;
    }
    
    public function getTitre(){
        return $this->titre;
    }

    public function getCategorie(){
        return $this->categorie;
    }

    public function getQuestions(){
        return $this->questions;
    }



    public function getFormattingQuizzJson($GET_idCard){

        $json = [
            'idQuizz' => $this->getIdQuizz(),
            'titre' => $this->getTitre(),
            'libelle' => $this->getCategorie()->getLibelle(),
            'idQuestion' => $this->getQuestions()[$GET_idCard]->getIdQuestion(),
            'idUtilisateur' => "remy",
            'description' => $this->getQuestions()[$GET_idCard]->getDescription(),
            'reponses' => [
                $this->getQuestions()[$GET_idCard]->getReponses()[0]->getIdReponse() => $this->getQuestions()[$GET_idCard]->getReponses()[0]->getReponse(),
                $this->getQuestions()[$GET_idCard]->getReponses()[1]->getIdReponse() => $this->getQuestions()[$GET_idCard]->getReponses()[1]->getReponse(),
                $this->getQuestions()[$GET_idCard]->getReponses()[2]->getIdReponse() => $this->getQuestions()[$GET_idCard]->getReponses()[2]->getReponse(),
                $this->getQuestions()[$GET_idCard]->getReponses()[3]->getIdReponse() => $this->getQuestions()[$GET_idCard]->getReponses()[3]->getReponse()
            ]
        ];

        return $json;
    }


    public function getFormattingStartCardQuizzJson(){

        $json = [
            'idQuizz' => $this->getIdQuizz(),
            'titre' => $this->getTitre(),
            'libelle' => $this->getCategorie()->getLibelle(),
            'pseudo' => $this->getPseudoCreateur()
        ];

        return $json;
    }

    public function getValuesResultatQuizz($idQuizz, $idUser){

        $requete = $this->getBdd()->prepare("SELECT idQuizz, titre, pseudo, description, r1.idReponse as id_reponse_utilisateur, (SELECT reponse FROM reponses_quizz WHERE idReponse = r1.idReponse) as reponse_utilisateur,idQuestion, r2.idReponse, reponse, vrai FROM reponses_users r1 INNER JOIN utilisateurs USING(idUtilisateur) INNER JOIN reponses_quizz r2 USING(idQuestion) INNER JOIN questions USING(idQuestion) INNER JOIN quizz USING(idQuizz) WHERE vrai = ? AND idQuizz = ? AND utilisateurs.idUtilisateur = ?");
        $requete->execute([1, $idQuizz, $idUser]);
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;

    }

    public function creerQuizz($titre, $idCategorie, $idUtilisateur){
        
        $requete = $this->getBdd()->prepare("INSERT INTO quizz(titre, idCategorie, idUtilisateur) VALUES ( ?, ? )");
        $requete->execute([$titre, $idCategorie, $idUtilisateur]);

        $requete = $this->getBdd()->prepare("SELECT MAX(idQuizz) as idQuizz FROM quizz");
        $requete->execute();

        return $requete->fetch(PDO::FETCH_ASSOC);
        
    }

    public function modifQuizz($titre, $idQuizz){
        
        $requete = $this->getBdd()->prepare("UPDATE quizz set titre = ? where idQuizz = ?");
        $requete->execute([$titre, $idQuizz]);
        
    }

    public function quizzParCategorie($idCategorie){

        $requete = $this->getBdd()->prepare("SELECT * FROM quizz WHERE idCategorie = ?");
        $requete->execute([$idCategorie]);

        return $requete->fetchAll(PDO::FETCH_ASSOC);

    }

    public function setIdQuizz($idQuizz){
        $this->idQuizz = $idQuizz;
    }

    public function setTitre($titre){

        $this->titre = $titre;
        $update = $this->getBdd()->prepare("UPDATE quizz SET description = ? WHERE idQuizz = ?");
        $update->execute([$titre, $this->getIdQuizz()]);

    }

    // m??thode demand??e en cours mais qui semble faire ?? peu pr??s la m??me chose que la m??thode creerQuestion de la classe Question
    public function addQuestion($question){

        $this->questions[] = $question;
        $update = $this->getBdd()->prepare("INSERT INTO questions(description, idQuizz) VALUES(?,?)");
        $update->execute([$question, $this->getIdQuizz()]);

    }

    public function removeQuestion($idQuestion){

        foreach ($this->questions as $clef => $valeur ) {
            if ( $valeur->getIdReponse() == $idQuestion ){

                unset($this->questions[$clef]);
                
            }
        }

    }

    public function recupQuizz(){
        $req = parent::getBdd()->prepare("SELECT * from quizz");
        $req->execute();
        $quizz = $req->fetchALL(PDO::FETCH_ASSOC);
        return $quizz;
    }

    public function getInfoQuizz($idQuizz){
        $requete = $this->getBdd()->prepare("SELECT * FROM quizz INNER JOIN categories USING(idCategorie) WHERE idQuizz = ?");
        $requete->execute([$idQuizz]);
        return $requete->fetch(PDO::FETCH_ASSOC);
    }
    public function recupQuizzNoValid(){
        $req = parent::getBdd()->prepare("SELECT * from quizz where validationAdmin = ?");
        $req->execute([0]);
        $quizz = $req->fetchALL(PDO::FETCH_ASSOC);
        return $quizz;
    }

    public function supQuizz($idQuizz){
        $req = parent::getBdd()->prepare("DELETE from quizz inner join score using(idQuizz) inner join questions USING(idQuizz) inner join reponse USING(idQuestion) where idQuizz = ?");
        $req->execute($idQuizz);
    }

    public function validQuizz($idQuizz){
        $req = parent::getBdd()->prepare("UPDATE quizz set validationAdmin = ? where idQuizz = ?");
        $req->execute([1, $idQuizz]);
    }

}
