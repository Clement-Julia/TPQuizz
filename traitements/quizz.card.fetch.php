<?php
require_once "../modeles/Modele.php";
require_once "../modeles/Quizz.php";

if(!isset($_GET["card"]) || !isset($_GET["quizz"])){

    $erreur = new stdClass();
    $erreur->message = "il faut un id de card dans la requete ainsi que l'id du quizz :)";
    http_response_code(404);
    echo json_encode($erreur);
    exit;

};

$Quizz = new Quizz();
$Quizz->getCardQuizz($_GET["quizz"]);
$carteQuizz = $Quizz->getInfoQuizz();
$carteQuizzJson = json_encode($carteQuizz[$_GET["card"]]);

if(!$carteQuizzJson){
    exit;
};

header('Content-Type: application/json;charset=utf-8');
echo $carteQuizzJson;

exit;
?>