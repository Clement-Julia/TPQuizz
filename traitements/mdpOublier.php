<?php
require_once "../Modele/modele.php";
require_once "../Modele/MdpOublier.php";
if(empty($_SESSION["email"])){
    $_SESSION["email"] = $_POST["email"];
}
$mdpOublier = new Mdp($_SESSION["email"]);

if(!isset($_GET["modif"])){
    if(empty($_POST["reponse"])){
        $email = $mdpOublier->getMdp($_POST["email"]);
        if(count($email) > 0){
            header("location:../vues/mdpOublier.php?status=exist");
        }else{
            header("location:../vues/mdpOublier.php?status=none");
        }
    }else{
        foreach($mdpOublier->getReponseSecrete($_SESSION["email"]) as $ontest){
            $reponse = $ontest["reponse_secrete"];
        }
        if($reponse == $_POST["reponse"]){
            header("location:../vues/mdpOublier.php?status=exist&reponse=correct");
        }else{
            header("location:../vues/mdpOublier.php?status=exist&reponse=false");
        }
    }
}

if(isset($_GET["modif"])){
    $_POST["newMdp"] = password_hash($_POST["newMdp"], PASSWORD_BCRYPT);
    $mdpOublier->modifMdp($_POST["newMdp"], $_SESSION["email"]);
    header("location:../vues/mdpOublier.php?status=end");
}