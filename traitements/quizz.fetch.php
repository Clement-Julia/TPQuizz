<?php
require_once "../modeles/Modele.php";
require_once "../modeles/Quizz.php";

if(!isset($_GET["id"])){

    $erreur = new stdClass();
    $erreur->message = "il faut un id dans la requete :)";
    http_response_code(404);
    echo json_encode($erreur);
    exit;

};

$Quizz = new Quizz(1);
$carteQuizz = $Quizz->getInfoQuizz();
$carteQuizzJson = json_encode($carteQuizz[$_GET["id"]]);

if(!$carteQuizzJson){
    exit;
};

header('Content-Type: application/json;charset=utf-8');
echo $carteQuizzJson;

exit;
?>