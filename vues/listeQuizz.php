<?php
require_once "header.php";
require_once "../traitements/traitement.php";
require_once "../vues/container.php";

$modele = new Modele();

$req = $modele->getBdd()->prepare("SELECT * from quizz");
$req->execute();
$quizz = $req->fetchALL(PDO::FETCH_ASSOC);

foreach($quizz as $quiz){
    ?>
    <div class="container_intro quiz_intro mt-5">
        <div class="row row_quiz_intro">
            <div class="col-md-6 col-xl-7 sep-md col_quiz_intro">
                <div class="d-flex align-items-center h-100">
                    <img class="quiz_img radius-md" src="<?=$quiz["logo"]?>" style="width:500px; height:250px">
                </div>
            </div>
            <div class="col-md-6 col-xl-5 col_quiz_intro">
                <div class="d-md-flex align-items-center h-100">
                    <div>
                        <h2 class="quiz_title mb-3">
                            <span class="sn_pencil" data-sn_uid="1454"><?=$quiz["titre"]?></span>
                        </h2>
                        <div class="quiz_desc">
                            <span class="sn_pencil" data-sn_uid="1455">Les questions s'affichent dans un ordre aléatoire. Vous ferez de nouvelles découvertes à chaque fois !</span>
                        </div>
                        <div class="d-flex justify-content-center mt-5">
                            <a href="#" class="btn_quiz btn btn-primary">
                                LANCER LE QUIZ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}


require_once "footer.php";