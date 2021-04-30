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

    public function getInsertValueBddResultatQuizz($valeurs){

        $str = "INSERT INTO reponses_users(idUtilisateur, idReponse, idQuestion) VALUES " . substr(str_repeat('(?,?,?),', count($valeurs) / 3), 0, -1);; 

        $requete = $this->getBdd()->prepare($str);
        $requete->execute($valeurs);

    }

    public function getValuesResultatQuizz($idQuizz, $idUser){

        $requete = $this->getBdd()->prepare("SELECT idQuizz, titre, pseudo, description, r1.idReponse as id_reponse_utilisateur, (SELECT reponse FROM reponses_quizz WHERE idReponse = r1.idReponse) as reponse_utilisateur,idQuestion, r2.idReponse, reponse, vrai FROM reponses_users r1 INNER JOIN utilisateurs USING(idUtilisateur) INNER JOIN reponses_quizz r2 USING(idQuestion) INNER JOIN questions USING(idQuestion) INNER JOIN quizz USING(idQuizz) WHERE vrai = ? AND idQuizz = ? AND utilisateurs.idUtilisateur = ?");
        $requete->execute([1, $idQuizz, $idUser]);
        $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);

        return $resultat;

    }

    public function creerQuizz($titre, $idCategorie){
        // il faudra rajouter l'idUtilisateur une fois les connexions ok
        $requete = $this->getBdd()->prepare("INSERT INTO quizz(titre, idCategorie) VALUES ( ?, ? )");
        $requete->execute([$titre, $idCategorie]);

        $requete = $this->getBdd()->prepare("SELECT MAX(idQuizz) as idQuizz FROM quizz");
        $requete->execute();

        return $requete->fetch(PDO::FETCH_ASSOC);
        
    }

    public function setIdQuizz($idQuizz){
        $this->idQuizz = $idQuizz;
    }
    public function setTitre($titre){
        $this->titre = $titre;
    }
    public function setCategorie($categorie){
        $this->categorie = $categorie;
    }

    public function addQuestion($question){
        $this->questions[] = $question;
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

}
