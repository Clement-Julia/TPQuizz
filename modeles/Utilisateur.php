<?php

class Utilisateur extends Modele {

    private $idUtilisateur;
    private $email;
    private $mdp;
    private $pseudo;
    private $questionSecrete; // objet
    private $reponseSecrete;
    private $role; // objet

    public function __construct($idUtilisateur = null){

        if ($idUtilisateur != null){

            $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE idUtilisateur = ?");
            $requete->execute([$idUtilisateur]);
            $infosUtilisateur = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idUtilisateur = $infosUtilisateur["idUtilisateur"];
            $this->email = $infosUtilisateur["email"];
            $this->mdp = $infosUtilisateur["mdp"];
            $this->pseudo = $infosUtilisateur["pseudo"];
            $this->reponseSecrete = $infosUtilisateur["reponseSecrete"];
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
        $this->idUtilisateur = $idUtilisateur;
    }

    public function setPseudo($pseudo){
        $this->pseudo = $pseudo;
    }

    public function setMdp($mdp){
        $this->mdp = $mdp; // sachant qu'on va devoir mettre le code de BCRIPT ici
    }

    public function setQuestionSecrete($questionSecrete){
        $this->questionSecrete = $questionSecrete;
    }

    public function setReponseSecrete($reponseSecrete){
        $this->reponseSecrete = $reponseSecrete;
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
        
        $emailRecup = $this->getEmailInscription($email);
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
    
    public function getEmailInscription($email){
        $requete = $this->getBdd()->prepare("SELECT * FROM utilisateurs WHERE email = ?");
        $requete->execute([$email]);
        return $requete->FetchAll(PDO::FETCH_ASSOC);

    }
}