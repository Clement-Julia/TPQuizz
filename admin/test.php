<?php
require_once "../modeles/Class.php";
$modele = new Quizz($_GET["id"]);
$Questions = $modele->getQuestions();
$x = 0;
$y = 0;
foreach($Questions as $Question){
    $TabIdQuestion[] = $Question->getIdQuestion();

    foreach ($Question->getReponses() as $reponse){
        $TabIdReponse[] = $reponse->getIdReponse();
    }
}

if ( 
    !empty($_POST["categorie"]) &&
    !empty($_POST["titre"]) &&
    !empty($_POST["question"])
    ){
        $Quizz = new Quizz();
        $Quizz->modifQuizz($_POST["titre"], $_GET["id"]);

        foreach ($_POST["question"] as $question ){
            $Question = new Question();
            $idQuestion = $Question->modifQuestion($question["question"], $TabIdQuestion[$x]);


            foreach ( $question["reponses"] as $reponse){

                $Reponse = new Reponse();
                $Reponse->modifReponse($reponse["reponse"], $TabIdReponse[$y]);

                $y++;
            }
            $x++;
        }

        header("location:../admin/modifierQuizz.php?success=1");

    } else {
        header("location:../admin/modifierQuizz.php?error=1");
    }