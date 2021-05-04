<?php
require_once "traitement.php";

if ( !empty($_POST["supprimer"]) ){

    $User = new Utilisateur($_SESSION["idUtilisateur"]);
    $User->supprimerAmis($_POST["supprimer"]);

    header("location:../vues/amis.php?success=1");

} else {

    header("location:../vues/amis.php?erreur=1");

}