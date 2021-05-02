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

    public function toutesLesCategories(){
        
        $requete = $this->getBdd()->prepare("SELECT * FROM categories");
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);

    }
    
    public function getIdCategorie(){
        return $this->idCategorie;
    }

    public function getLibelle(){
        return $this->libelle;
    }

    public function setIdCategorie($idCategorie){
        $this->idCategorie = $idCategorie;
    }

    public function setLibelle($libelle){
        $this->libelle = $libelle;
        $update = $this->getBdd()->prepare("UPDATE categories SET libelle = ? WHERE idCategorie = ?");
        $update->execute([$libelle, $this->getIdCategorie()]);
    }

}