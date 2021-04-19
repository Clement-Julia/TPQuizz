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
                $return["error"] = "Le mot de passe n'est pas correct";
            }

            $_SESSION["pseudo"] = $pseudo;

        } else {
            $return["success"] = false;
            $return["error"] = "Le pseudo n'existe pas";
        }

        return $return;

    }

    public function inscription($email, $mdp, $pseudo, $reponseSecrete, $questionSecrete, $idRole){

        $requete = $this->getBdd()->prepare("INSERT INTO utilisateurs(email, mdp, pseudo, reponse_secrete, idQuestionS, idRole) VALUES (?, ?, ?, ?, ?, ?);");
        $requete->execute([$email, $mdp, $pseudo, $reponseSecrete, $questionSecrete, $idRole]);

    }


}