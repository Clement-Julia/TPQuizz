<?php
require_once "../Modele/modele.php";
require_once "../Modele/Connexion.php";
$connexion = new Connexion();
$erreurs = [];

if(empty($_POST["identifiant"]) || empty($_POST["mdp"])){
    $erreurs[] = 0;
}

if(count($erreurs) == 0){
    $utilisateur = $connexion->verifConnexion($_POST["identifiant"]);
    if(count($utilisateur) > 0){
        if(!password_verify($_POST["mdp"], $utilisateur["mdp"])){
            $erreurs[] = 1;
        }
    }else {
        $erreurs[] = 2;
    }
}

if(count($erreurs) == 0){
    $_SESSION["idUtilisateur"] = $utilisateur["idUtilisateur"];
    $_SESSION["pseudo"] = $utilisateur["pseudo"];
    $_SESSION["role"] = $utilisateur["idRole"];
    
    header("refresh:0;../vues/");
    // if($_SESSION["Role"] == 1){
    // }else {
    //     header("refresh:0;../admin/indexAdmin.php");
    // }
}else {
    $href = "../user/connexion.php?err=yes&";
    foreach($erreurs as $erreur){
        $href .= $erreur . ",";
    }
    $href = substr($href, 0, -1);

    header("location:" . $href);
}