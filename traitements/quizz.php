<?php
require_once "traitement.php";

if ( 
    isset($_POST["question-1"]) &&
    !empty($_POST["id-question-1"]) &&
    isset($_POST["question-2"]) &&
    !empty($_POST["id-question-2"]) &&
    isset($_POST["question-3"]) &&
    !empty($_POST["id-question-3"]) &&
    isset($_POST["question-4"]) &&
    !empty($_POST["id-question-4"]) &&
    isset($_POST["question-5"]) &&
    !empty($_POST["id-question-5"]) &&
    isset($_POST["question-6"]) &&
    !empty($_POST["id-question-6"]) &&
    isset($_POST["question-7"]) &&
    !empty($_POST["id-question-7"]) &&
    isset($_POST["question-8"]) &&
    !empty($_POST["id-question-8"]) &&
    isset($_POST["question-9"]) &&
    !empty($_POST["id-question-9"]) &&
    isset($_POST["question-10"]) &&
    !empty($_POST["id-question-10"]) &&
    !empty($_GET["quizz"])
    ){

        $POST = [];
        for($i = 1; $i < 11; $i++){
            $POST[] = $_SESSION["idUtilisateur"];
            $POST[] = $_POST["question-" . $i . ""];
            $POST[] = $_POST["id-question-" . $i . ""];
        }

        $ReponsesUser = new Reponses_User();
        $ReponsesUser->getInsertValueBddResultatQuizz($POST);
        header("location:../vues/resultatQuizz.php?quizz=" . $_GET["quizz"]);

    } else {

        

    }
    