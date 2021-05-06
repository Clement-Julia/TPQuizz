<?php

class Categorie extends Modele {

    private $idCategorie;
    private $libelle;
    private $icone;

    public function __construct($idCategorie = null){

        if ( $idCategorie !== null){
            $requete = $this->getBdd()->prepare("SELECT libelle, icone FROM Categories WHERE idCategorie = ?");
            $requete->execute([$idCategorie]);
            $libelle = $requete->fetch(PDO::FETCH_ASSOC);

            $this->idCategorie = $idCategorie;
            $this->libelle = $libelle["libelle"];
            $this->icone = $libelle["icone"];
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

    public function getIcone(){
        return $this->icone;
    }

    public function setIdCategorie($idCategorie){
        $this->idCategorie = $idCategorie;
    }

    public function setLibelle($libelle){
        $this->libelle = $libelle;
        $update = $this->getBdd()->prepare("UPDATE categories SET libelle = ? WHERE idCategorie = ?");
        $update->execute([$libelle, $this->getIdCategorie()]);
    }

    public function ajoutCat($libelle, $icone){
        $req = $this->getBdd()->prepare("INSERT INTO categories(libelle, icone) values(?,?)");
        $req->execute([$libelle, $icone]);
    }

    public function supCat($idCat){
        $req = $this->getBdd()->prepare("DELETE from categories where idCategorie = ?");
        $req->execute([$idCat]);
    }

    public function meilleurJoueurCats(){

        $requete = $this->getBdd()->prepare("SELECT pseudo, libelle, AVG(score) as moyenne FROM score INNER JOIN quizz USING(idQuizz) INNER JOIN categories USING(idCategorie) INNER JOIN utilisateurs ON score.idUtilisateur = utilisateurs.idUtilisateur GROUP BY libelle, pseudo ORDER BY libelle, score DESC");
        $requete->execute();
        $infos = $requete->fetchAll(PDO::FETCH_ASSOC);

        $tableau = [];
        $categories = $this->toutesLesCategories();

        foreach ( $categories as $categorie ){
            $tableau[$categorie["libelle"]]["libelle"] = $categorie["libelle"];
            $tableau[$categorie["libelle"]]["pseudo"] = [];
            $tableau[$categorie["libelle"]]["moyenne"] = [];
        }

        foreach ( $infos as $info ){

            if ( empty($tableau[$info["libelle"]]["moyenne"]) ){

                $tableau[$info["libelle"]]["pseudo"][0] = $info["pseudo"];
                $tableau[$info["libelle"]]["moyenne"][0] = $info["moyenne"];

            } else if ( $info["moyenne"] == $tableau[$info["libelle"]]["moyenne"][0] ){

                array_push($tableau[$info["libelle"]]["pseudo"], $info["pseudo"]);
                array_push($tableau[$info["libelle"]]["moyenne"], $info["moyenne"]);

            }

        }

        return $tableau;

    }

}