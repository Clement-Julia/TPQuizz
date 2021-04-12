<?php
class Inscription extends Modele {

    protected $pseudo;
    private $pw;

    public function __construct($identifiant, $mdp){
        $this->pseudo = $identifiant;
        $this->pw = $mdp;
    }

    public function getIdentifiant($identifiant){
        $requete = parent::getBdd()->prepare("SELECT pseudo FROM utilisateurs WHERE pseudo = ?");
        $requete->execute([$identifiant]);
        $identifiant = $requete->FetchAll(PDO::FETCH_ASSOC);
        return $identifiant;
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

    function inscriptionBdd($identifiant, $mdp){
        $requete = parent::getBdd()->prepare("INSERT INTO utilisateurs(pseudo, mdp, idRole) VALUES (?, ?, ?);");
        $requete->execute([$identifiant, $mdp, 1]);
    }
}