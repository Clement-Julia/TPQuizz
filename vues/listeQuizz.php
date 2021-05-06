<?php
require_once "header.php";
require_once "../traitements/traitement.php";
require_once "../vues/container.php";

$modele = new Quizz();
$quizz = $modele->recupQuizz();
?>
<div id="bg-afficher-quizz"></div>
<div class="overflow">
<?php
foreach($quizz as $quiz){
    ?>
    <div class ="d-flex justify-content-center">
        <div class="container_intro mt-5">
            <div class="row">
                <div class="col-md-6 col-xl-7 sep-md col_quiz_intro" style="max-width:400px; height:200px">
                    <div class="d-flex align-items-center h-100">
                        <img class="quiz_img radius-md" src="<?=$quiz["logo"]?>" >
                    </div>
                </div>
                <div class="col-md-6 col-xl-5 col_quiz_intro">
                    <div class="d-md-flex align-items-center h-100">
                        <div>
                            <h2 class="quiz_title mb-3 text-center">
                                <span class="sn_pencil" data-sn_uid="1454"><?=$quiz["titre"]?></span>
                            </h2>
                            <div class="quiz_desc">
                                <span class="sn_pencil" data-sn_uid="1455">Les questions s'affichent dans un ordre aléatoire. Vous ferez de nouvelles découvertes à chaque fois !</span>
                            </div>
                            <div class="d-flex justify-content-center mt-5">
                                <a href="quizz.php?quizz=<?=$quiz["idQuizz"];?>" class="btn_quiz btn btn-primary">
                                    LANCER LE QUIZ
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>
</div>
<div class= "mt-5"></div>
<?php

require_once "footer.php";