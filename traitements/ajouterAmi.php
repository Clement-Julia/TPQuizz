<?php
require_once "traitement.php";

if ( !empty($_POST["ami"]) ){
    $User = new Utilisateur($_SESSION["idUtilisateur"]);
    $booleen = $User->ajouterAmi($_POST["ami"]);

    if ($booleen) {
        header("location:../vues/amis.php?ami=1");
    } else {
        header("location:../vues/amis.php?amiErreur=1");
    }
}