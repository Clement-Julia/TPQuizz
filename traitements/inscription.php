<?php
require_once "../Modele/modele.php";
require_once "../Modele/Inscription.php";
$inscription = new Inscription($_POST["identifiant"], $_POST["mdp"], $_POST["email"]);

$erreurs = [];
$erreursMdp = [];

if(!empty($_POST["identifiant"]) && 
    !empty($_POST["mdp"]) && 
    !empty($_POST["mdpVerif"])
){
    $email = $inscription->getEmail($_POST["email"]);
    if(count($email) > 0){
        $erreurs[] = 0;
    }

    $checkMdp = $inscription->check_mdp_format($_POST["mdp"]);
    if(count($checkMdp) > 0){
        foreach($checkMdp as $erreur){
            $erreursMdp[] = $erreur;
        }
    }

    if($_POST["mdp"] !== $_POST["mdpVerif"]){
        $erreurs[] = 1;
    }
}else {
    $erreurs[] = 3;
}

if(count($erreurs) === 0 && count($erreursMdp) === 0){

    try {
        $mdp = password_hash($_POST["mdp"], PASSWORD_BCRYPT);
        $inscription->inscriptionBdd($_POST["identifiant"], $mdp);
        header("location:../vues/");
    }catch(Exception $e){
        header("location:../vues/inscription.php?error");
    }
}else{
    $href = "../vues/inscription.php?err=yes&nb=";
    $erreurs = array_merge($erreurs, $erreursMdp);
    foreach($erreurs as $erreur){
        $href .= $erreur . ",";
    }
    $href = substr($href, 0, -1);

    header("location:" . $href);
}