<?php
class AQ extends Modele {

    public function search(){
        $explode = explode(" ", $_GET["filtre"]);
        $repet = [];

        for($x = 0; $x < count($explode); $x++){
            $repet[] = "titre LIKE '%$explode[$x]%' OR ";
        }
        $implode = implode(" ", $repet);
        $implode = substr($implode, 0, -4);

        $sql = "SELECT * from quizz where $implode";

        $req = parent::getBdd()->prepare($sql);
        $req->execute();
        $quizz = $req->fetch(PDO::FETCH_ASSOC);
        return $quizz;
    }
}