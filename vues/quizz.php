<?php
require_once "header.php";
require_once "../Modele/modele.php";
require_once "../Modele/Quizz.php";
require_once "../Modele/Categorie.php";
require_once "../Modele/Question.php";
require_once "../Modele/Reponse.php";

$Quizz = new Quizz(1);

?>
<pre>
    <?php
    print_r($Quizz);
    ?>
</pre>