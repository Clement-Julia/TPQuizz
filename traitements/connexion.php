<?php
require_once "../traitements/traitement.php";
$connexion = new Utilisateur();
$erreurs = [];

if(empty($_POST["identifiant"]) || empty($_POST["mdp"])){
    $erreurs[] = 0;
}


if(count($erreurs) == 0){
    
    $erreurt = $connexion->connexion($_POST["identifiant"], $_POST["mdp"]);
    $erreurs[] = $erreurt["error"];
}

if(count($erreurs) == 0){

    header("refresh:0;../vues/");
}else {

    $href = "../vues/connexion.php?err=yes&";
    foreach($erreurs as $erreur){
        $href .= $erreur . ",";
    }
    $href = substr($href, 0, -1);

    header("location:" . $href);
}