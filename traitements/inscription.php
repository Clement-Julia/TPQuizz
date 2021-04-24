<?php
require_once "../traitements/traitement.php";
$inscription = new Utilisateur();

$erreurs = [];

if(!empty($_POST["identifiant"]) && 
    !empty($_POST["mdp"]) && 
    !empty($_POST["mdpVerif"])
){
    
    $erreurt = $inscription->inscription($_POST["email"], $_POST["mdp"], $_POST["identifiant"], $_POST["reponseS"], $_POST["questionS"], 1);
    if(count($erreurt["error"]) > 0){
        $erreurs[] = $erreurt["error"];
    }

}else {
    $erreurs[] = 3;
}

if(count($erreurs) === 0){
    header("location:../vues/");
}else{
    $href = "../vues/inscription.php?err=yes&nb=";
    foreach($erreurs as $erreurReset){
        foreach($erreurReset as $erreur){
            $href .= $erreur . ",";
        }
    }
    $href = substr($href, 0, -1);

    header("location:" . $href);
}
print_r($erreurt);