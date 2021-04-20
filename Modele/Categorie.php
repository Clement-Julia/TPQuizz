<?php

class Categorie extends Modele {

    private $idCategorie;
    private $libelle;

    public function __construct($idCategorie = null){

        if ( $idCategorie !== null){
            $requete = $this->getBdd()->prepare("SELECT libelle FROM Categories WHERE idCategorie = ?");
            $requete->execute([$idCategorie]);
            $libelle = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idCategorie = $idCategorie;
            $this->libelle = $libelle["libelle"];
        }

    }
    
    public function getIdCategorie(){
        return $this->idCategorie;
    }

    public function getLibelle(){
        return $this->libelle;
    }

}