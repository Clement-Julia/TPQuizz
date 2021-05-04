<?php

class Utilisateur extends Modele {

    private $idUtilisateur;
    private $email;
    private $mdp;
    private $pseudo;
    private $questionSecrete; // objet
    private $reponseSecrete;
    private $role; // objet
    private $scores = []; // tableau d'objet
    private $scoreAmis = [];
    private $amis = []; //tableau d'objet

    public function __construct($idUtilisateur = null){

        if ($idUtilisateur != null){

            $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
            $requete->execute([$idUtilisateur]);
            $infosUtilisateur = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idUtilisateur = $infosUtilisateur["idUtilisateur"];
            $this->email = $infosUtilisateur["email"];
            $this->mdp = $infosUtilisateur["mdp"];
            $this->pseudo = $infosUtilisateur["pseudo"];
            $this->reponseSecrete = $infosUtilisateur["reponse_secrete"];
            $this->questionSecrete = new QuestionSecrete($infosUtilisateur["idQuestionS"]);
            $this->role = new Role($infosUtilisateur["idRole"]);
        }

    }

    public function getIdUtilisateur(){
        return $this->idUtilisateur;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getMdp(){
        return $this->mdp;
    }

    public function getPseudo(){
        return $this->pseudo;
    }

    public function getQuestionSecrete(){
        return $this->questionSecrete;
    }

    public function getReponseSecrete(){
        return $this->reponseSecrete;
    }

    public function getRole(){
        return $this->role;
    }

    public function setIdUtilisateur($idUtilisateur){

        $this->idUtilisateur = $idUtilisateur; //On ne voit pas l'intérêt de pouvoir modifier ce paramètre

    }

    public function setPseudo($pseudo){

        $this->pseudo = $pseudo;

        $update = $this->getBdd()->prepare("UPDATE utilisateurs SET pseudo = ? WHERE idUtilisateur = ?");
        $update->execute([$pseudo, $this->getIdUtilisateur()]);

    }

    public function setMdp($newMdp, $id){
        $newMdp = password_hash($newMdp, PASSWORD_BCRYPT);
        $req = parent::getBdd()->prepare("UPDATE utilisateurs set mdp = ? WHERE idUtilisateur = ?");
        $req->execute([$newMdp, $id]);
    }


    public function setQuestionSecrete($IdQuestionSecrete){

        $this->questionSecrete = new QuestionSecrete($IdQuestionSecrete);

        $update = $this->getBdd()->prepare("UPDATE utilisateurs SET idQuestionS = ? WHERE idUtilisateur = ?");
        $update->execute([$IdQuestionSecrete, $this->getIdUtilisateur()]);

    }

    public function setReponseSecrete($reponseSecrete){

        $this->reponseSecrete = $reponseSecrete;

        $update = $this->getBdd()->prepare("UPDATE utilisateurs SET reponse_secrete = ? WHERE idUtilisateur = ?");
        $update->execute([$reponseSecrete, $this->getIdUtilisateur()]);

    }

    public function connexion($pseudo, $mdp){ // faudrait-il pas rajouter l'idUtilisateur pour l'inclure dans la variable $_SESSION
        
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE pseudo = ?");
        $requete->execute([$pseudo]);

        $return = [
            "success" => true,
            "error" => []
        ];

        if($requete->rowCount() > 0){

            $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
            
            if(!password_verify($mdp, $utilisateur["mdp"])){
                $return["success"] = false;
                $return["error"] = 1;
            }else{

                $this->idUtilisateur = $utilisateur["idUtilisateur"];
                $this->role = $utilisateur["idRole"];
                $this->email = $utilisateur["email"];
                $_SESSION["idUtilisateur"] = $this->getIdUtilisateur();
                $_SESSION["pseudo"] = $pseudo;
                $_SESSION["role"] = $this->getRole();
                $_SESSION["email"] = $this->getEmail();
                $_SESSION["mdp"] = $mdp;
            }


        } else {
            $return["success"] = false;
            $return["error"] = 2;
        }

        return $return;

    }

    public function inscription($email, $mdp, $pseudo, $reponseSecrete, $questionSecrete, $idRole){

        $return = [
            "success" => true,
            "error" => []
        ];
        
        $emailRecup = $this->getEmailUser($email);
        if(count($emailRecup) > 0){
            $return["success"] = false;
            $return["error"][] = 0;
        }

        $checkMdp = $this->check_mdp_format($mdp);
        if(count($checkMdp) > 0){
            $return["success"] = false;
            $return["error"] = array_merge($return["error"], $checkMdp);
        }

        if($_POST["mdp"] !== $_POST["mdpVerif"]){
            $return["success"] = false;
            $return["error"][] = 1;
        }

        if(empty($return["error"])){

            $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT);
            $requete = $this->getBdd()->prepare("INSERT INTO utilisateurs(email, mdp, pseudo, reponse_secrete, idQuestionS, idRole) VALUES (?, ?, ?, ?, ?, ?);");
            $requete->execute([$email, $mdp, $pseudo, $reponseSecrete, $questionSecrete, $idRole]);
        }

        return $return;

    }

    public function check_mdp_format($mdp){

        $erreursMdp = [];
        $minuscule = preg_match("/[a-z]/", $mdp);
        $majuscule = preg_match("/[A-Z]/", $mdp);
        $chiffre = preg_match("/[0-9]/", $mdp);
        $caractereSpecial = preg_match("/[^a-zA-Z0-9]/", $mdp);
        $str = strlen($mdp);
    
        if(!$minuscule){
            $erreursMdp[] = 4;
        }
        if(!$majuscule){
            $erreursMdp[] = 5;
        }
        if(!$chiffre){
            $erreursMdp[] = 6;
        }
        if(!$caractereSpecial){
            $erreursMdp[] = 7;
        }
        if($str < 8){
            $erreursMdp[] = 8;
        }
    
        return $erreursMdp;
    }
    
    public function getEmailUser($email){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $requete->execute([$email]);
        return $requete->Fetch(PDO::FETCH_ASSOC);

    }

    public function getQuestion($email){
        $req = parent::getBdd()->prepare("SELECT question FROM question_secrete INNER JOIN utilisateurs USING(idQuestionS) where idUtilisateur = ?");
        $req->execute([$email]);
        $question = $req->Fetch(PDO::FETCH_ASSOC);
        return $question;
    }

    public function getReponseSecreteUser($email){
        $req = parent::getBdd()->prepare("SELECT reponse_secrete FROM utilisateurs where idUtilisateur = ?");
        $req->execute([$email]);
        $reponse = $req->Fetch(PDO::FETCH_ASSOC);
        return $reponse;
    }

    public function getScore(){

        $requete = $this->getBdd()->prepare("SELECT * FROM score WHERE idUtilisateur = ?");
        $requete->execute([$this->getIdUtilisateur()]);
        $infos = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach ( $infos as $info ){

            $score = new Score();
            $score->initialiserScore($info["idUtilisateur"], $info["idQuizz"], $info["score"]);
            $this->scores[] = $score;

        }

        return $this->scores;

    }

    public function getScoreAmis(){

        $requete = $this->getBdd()->prepare("SELECT * FROM amis WHERE idUtilisateur1 = ?");
        $requete->execute([$this->getIdUtilisateur()]);
        $infos = $requete->fetchAll(PDO::FETCH_ASSOC);

        $amis = [];
        $nbAmis = substr(str_repeat("?,", count($infos)), 0, -1);
        foreach ( $infos as $info ){
            $amis[] = $info["idUtilisateur2"];
        }

        $requete = $this->getBdd()->prepare("SELECT * FROM score WHERE idUtilisateur IN ($nbAmis) ORDER BY score DESC");
        $requete->execute($amis);
        $infosScore = $requete->fetchAll(PDO::FETCH_ASSOC);

        $this->scoreAmis = $infosScore;

        return $this->scoreAmis;

    }

    public function getAmis(){

        $requete = $this->getBdd()->prepare("SELECT * FROM amis WHERE idUtilisateur1 = ?");
        $requete->execute([$this->getIdUtilisateur()]);
        $infos = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach ( $infos as $info ){

            $this->amis[] = new Ami($_SESSION["idUtilisateur"], $info["idUtilisateur2"]);

        }

        return $this->amis;

    }

    public function supprimerAmis($tabs){

        $nbAmisSupprime = substr(str_repeat("?,", count($tabs)), 0, -1);
        array_unshift($tabs, $this->getIdUtilisateur());

        $requete = $this->getBdd()->prepare("DELETE FROM amis WHERE idUtilisateur1 = ? AND idUtilisateur2 IN ($nbAmisSupprime)");
        $requete->execute($tabs);


    }

    public function ajouterAmi($pseudo){

        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE pseudo = ?");
        $requete->execute([$pseudo]);
        $info = $requete->fetch(PDO::FETCH_ASSOC);
        $count = $requete->rowCount();

        if ($count > 0){

            $requete = $this->getBdd()->prepare("INSERT INTO amis VALUES (?, ?)");
            $requete->execute([$this->getIdUtilisateur(), $info["idUtilisateur"]]);

            return true;

        } else {

            return false;

        }

    }

}