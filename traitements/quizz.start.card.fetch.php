<?php
require_once "../modeles/Class.php";

if( !isset($_GET["quizz"]) ){

    $erreur = new stdClass();
    $erreur->message = "il faut l'id du quizz :)";
    http_response_code(404);
    echo json_encode($erreur);
    exit;

};

$Quizz = new Quizz($_GET["quizz"]);
$json = $Quizz->getFormattingStartCardQuizzJson();
$json = json_encode($json);

if(!$json){
    exit;
};

header('Content-Type: application/json;charset=utf-8');
echo $json;

exit;
?>