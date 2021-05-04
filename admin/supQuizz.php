<?php
require_once "../traitements/traitement.php";
$Quizz = new Quizz();
$Quizz->supQuizz($_GET["id"]);
header("location:../admin/modifierQuizz");