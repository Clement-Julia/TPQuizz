<?php
require_once "../traitements/traitement.php";
$Cat = new Categorie();

if(!empty($_POST["nom"]) && !empty($_POST["icone"])){
    $Cat->ajoutCat($_POST["nom"], $_POST["icone"]);
    header("location:ajoutCat.php?success");
}else{
    header("location:ajoutCat.php?error");
}