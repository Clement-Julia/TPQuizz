<?php

class Role extends Modele {

    private $idRole;
    private $libelle;

    public function __construct($idRole){

        if ( $idRole != null ){

            $requete = $this->getBdd()->prepare("SELECT * FROM role WHERE idRole = ?");
            $requete->execute([$idRole]);
            $infosRole = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idRole = $infosRole["idRole"];
            $this->libelle = $infosRole["libelle"];

        }

    }

    public function getIdRole(){
        return $this->idRole;
    }

    public function getLibelle(){
        return $this->libelle;
    }

    public function setIdRole($idRole){
        $this->idRole = $idRole;
    }

    public function setLibelle($libelle){
        $this->libelle = $libelle;
    }

}