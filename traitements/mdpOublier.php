<?php
require_once "../traitements/traitement.php";

$mdpOublier = new Utilisateur();

if(!isset($_GET["modif"])){
    if(empty($_POST["reponse"])){
        $email = $mdpOublier->getEmailUser($_POST["email"]);
        if(!empty($email)){
            header("location:../vues/mdpOublier.php?status=exist&user=". $email["idUtilisateur"]);
        }else{
            header("location:../vues/mdpOublier.php?status=none");
        }
    }else{
        $ontest = $mdpOublier->getReponseSecreteUser($_GET["user"]);
        $reponse = $ontest["reponse_secrete"];
        if($reponse == $_POST["reponse"]){
            header("location:../vues/mdpOublier.php?status=exist&reponse=correct&user=" . $_GET["user"]);
        }else{
            header("location:../vues/mdpOublier.php?status=exist&reponse=false&user=" . $_GET["user"]);
        }
    }
}

if(isset($_GET["modif"])){

    $mdpOublier->setMdp($_POST["newMdp"], $_GET["user"]);
    header("location:../vues/mdpOublier.php?status=end");
}