<?php
require_once "../traitements/traitement.php";
$Cat = new Categorie();
$Quizz = new Quizz();

if(count($Quizz->quizzParCategorie($_GET["id"])) == 0){
    $Cat->supCat($_GET["id"]);
    header("location:../admin/modifierCat?success");
}else{
    header("location:../admin/modifierCat?error=exist");
}