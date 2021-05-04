<?php
require_once "header.php";
require_once "../traitements/traitement.php";
require_once "../admin/sidebar.php";

$modele = new Quizz();
$quizz = $modele->recupQuizzNoValid();

if(isset($_GET["verif"])){
    $modele = new Quizz($_GET["verif"]);
    $Questions = $modele->getQuestions();
}
?>

<?php
if ( !empty($_GET["success"]) ){
    ?>
    <div class="alert alert-success">Le Quizz a bien été validé !</div>
    <?php
}
if ( !empty($_GET["error"]) ){
    ?>
    <div class="alert alert-warning">Une erreur est survenue pendant la validation du quizz :/</div>
    <?php
}
if(empty($_GET["verif"]) && !empty($quizz)){
    ?>
    <p class="text-muted text-center h3 my-3">Liste des quizz non validés :</p>
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
                                    <a href="validationQuizz.php?verif=<?=$quiz["idQuizz"];?>" class="btn_quiz btn btn-primary">
                                        Vérifier le quizz
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
    <div class= "mt-5"></div>
    <?php
}elseif (!empty($_GET["verif"])) {
    ?>
    <div class="container mt-5">
        <div class="input-group mb-3">
            <span class="input-group-text input-group-text-default-size" id="inputGroup-sizing-default">Catégorie</span>
            <select class="form-select" name="categorie" aria-label="Default select example">
                <option hidden disabled>Choisissez une catégorie</option>
                <?php
                foreach ( $Cats as $Cat ){
                    ?>
                    <option <?=$modele->getCategorie()->getLibelle() == $Cat["libelle"] ? "selected" : "";?> value="<?=$Cat["idCategorie"];?>"><?=$Cat["libelle"];?></option>
                    <?php
                }
                ?>
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text input-group-text-default-size" id="inputGroup-sizing-default">Titre du Quiz</span>
            <input type="text" class="form-control" name="titre" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?=$modele->getTitre()?>">
        </div>

        <hr class="dropdown-divider my-5">

        <?php
        $i = 1;
        foreach($Questions as $Question){
            $x = 0;
            ?>
            <div class="input-group mb-3">
                <span class="input-group-text input-group-text-default-size" id="inputGroup-sizing-default">Question N°<?=$i?></span>
                <input type="text" class="form-control" name="question[<?=$i;?>][question]" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" value="<?=$Question->getDescription()?>">
            </div>
            <?php
            foreach($Question->getReponses() as $reponse){
                ?>
                <div class="input-group my-2">
                    <div class="input-group-text">
                        <input class="form-check-input mt-0" type="hidden" name="question[<?=$i;?>][reponses][<?=$x?>][vrai]" value="<?=($x == 0) ? 1 : 0;?>" aria-label="Radio button for following text input">
                    </div>
                    <input type="text" class="form-control <?=($x == 0) ? "input-success" : "";?>" name="question[<?=$i;?>][reponses][<?=$x?>][reponse]" aria-label="Text input with radio button" placeholder="La réponse correcte" value="<?=$reponse->getReponse()?>">
                </div>
                <?php

                $x++;        
            }
            ?>
            <hr class="dropdown-divider my-5">
            <?php
            $i++;
        }
        ?>

        <div class="d-flex justify-content-center mb-5">
            <a href="validQuizz.php?id=<?=$_GET["verif"]?>"><button id="submit" type="submit" class="btn btn-info">Valider</button></a>
            <a href="supQuizz.php?id=<?=$_GET["verif"]?>"><button id="submit" type="submit" class="btn btn-danger">Refuser</button></a>
        </div>
    </div>
    <?php
}else{
    ?>
    <p class="text-muted text-center h1 my-5">Aucun quizz n'est en attente</p>
    <?php
}

require_once "footer.php";