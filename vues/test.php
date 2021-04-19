<?php
require_once "../modeles/Class.php";

$test = new Quizz(1);
echo $test->getQuestions()[0]->removeReponse(39);