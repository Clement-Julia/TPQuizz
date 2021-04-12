<?php
require_once "../modeles/Modele.php";
require_once "../modeles/Quizz.php";

if( !isset($_GET["quizz"]) ){

    $erreur = new stdClass();
    $erreur->message = "il faut l'id du quizz :)";
    http_response_code(404);
    echo json_encode($erreur);
    exit;

};

$Quizz = new Quizz();
$CardStartQuizz = $Quizz->getInfoQuizzStartCard($_GET["quizz"]);
$CardStartQuizzJson = json_encode($CardStartQuizz);
echo $CardStartQuizzJson;
exit;

if(!$CardStartQuizzJson){
    exit;
};

header('Content-Type: application/json;charset=utf-8');
echo $CardStartQuizzJson;

exit;
?>