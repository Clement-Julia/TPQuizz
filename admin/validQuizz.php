<?php
require_once "../traitements/traitement.php";

if (!empty($_POST["categorie"]) &&
    !empty($_POST["titre"]) &&
    !empty($_POST["question"])){

    $Quizz = new Quizz();
    $Quizz->validQuizz($_GET["id"]);
    header("location:../admin/validationQuizz.php?success");    
}else{
    header("location:../admin/validationQuizz.php?error");    
}