<?php
// les setters ne sont pas encore fait
class Ami extends Modele {

    private $utilisateur1; // objet
    private $utilisateur2; // objet
    

    public function __construct($idUtilisateur1, $idUtilisateur2){

        $this->utilisateur1 = new Utilisateur($idUtilisateur1);
        $this->utilisateur2 = new Utilisateur($idUtilisateur2);

    }

    public function getUtilisateur1(){
        return $this->utilisateur1;
    }

    public function getUtilisateur2(){
        return $this->utilisateur2;
    }

}