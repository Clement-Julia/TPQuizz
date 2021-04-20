<?php
require_once "../modeles/Class.php";


if ( 
    !empty($_POST["categorie"]) &&
    !empty($_POST["titre"]) &&
    !empty($_POST["question"])
    ){

        $Quizz = new Quizz();
        $idQuizz = $Quizz->creerQuizz($_POST["titre"], $_POST["categorie"]);

        foreach ( $_POST["question"] as $question ){

            $Question = new Question();
            $idQuestion = $Question->creerQuestion($question["question"], $idQuizz["idQuizz"]);


            foreach ( $question["reponses"] as $reponse){

                $Reponse = new Reponse();
                $Reponse->creerReponse($reponse["reponse"], $reponse["vrai"], $idQuestion["idQuestion"]);

            }

        }

        header("location:../vues/ajouterQuizz.php?success=1");

    } else {
        header("location:../vues/ajouterQuizz.php?error=1");
    }