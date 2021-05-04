<?php
require_once "header.php";
require_once "../traitements/traitement.php";
require_once "../admin/sidebar.php";

if(empty($_GET["categorie"])){
    $modele = new Quizz();
    $quizz = $modele->recupQuizz();
}else{
    $Quizz = new Quizz();
    $quizz = $Quizz->quizzParCategorie($_GET["categorie"]);
}

$modele = new Categorie();
$Cats = $modele->toutesLesCategories();

if(isset($_GET["filtre"])){
    $modele = new AQ();
    $quizz = $modele->search();
}

if(isset($_GET["id"])){
    $modele = new Quizz($_GET["id"]);
    $Questions = $modele->getQuestions();
}

?>
<div class="container">
<?php
    if ( !empty($_GET["success"]) ){
        ?>
        <div class="alert alert-success">Le Quizz a bien été modifié !</div>
        <?php
    }
    if ( !empty($_GET["error"]) ){
        ?>
        <div class="alert alert-warning">Une erreur est survenue pendant la modification du quizz :/</div>
        <?php
    }
?>
<div class="d-flex justify-content-center mt-5">
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false" style ="width: 150px">
        Catégories 
        <span class="visually-hidden"></span>
    </button>
    <ul class="dropdown-menu">
        <?php
        foreach($Cats as $Cat){
            ?>
            <li><a class="dropdown-item" href="../admin/modifierQuizz.php?categorie=<?=$Cat["idCategorie"]?>"><?=$Cat["libelle"]?></a></li>
            <?php
        }
        ?>
    </ul>
    <div class="d-flex justify-content-center px-5">
        <form action="../admin/redirectionAdmin.php" method="post">
            <input type="text" class="search-input" placeholder="Search..." name="search"> <a href="#"></a>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </form>
    </div>
    <a href="validationQuizz.php"><button class="btn btn-primary">
        Quizz non validés <i class="fas fa-chevron-right"></i>
    </button></a>
</div>

<?php

if(empty($_GET["filtre"]) && empty($_GET["id"])){
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
                                <div class="d-flex btn-group justify-content-center mt-5">
                                    <a href="modifierQuizz.php?id=<?=$quiz["idQuizz"]?>" class="btn_quiz btn btn-warning">
                                        Modifier le quizz
                                    </a>
                                    <a href="supQuizz.php?id=<?=$quiz["idQuizz"]?>" class="btn_quiz btn btn-danger">
                                        Supprimer le quizz
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
}elseif(empty($_GET["id"])){
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
                                <div class="d-flex btn-group justify-content-center mt-5">
                                    <a href="#" class="btn_quiz btn btn-warning">
                                        Modifier le quizz
                                    </a>
                                    <a href="supQuizz.php?id=<?=$quiz["idQuizz"]?>" class="btn_quiz btn btn-danger">
                                        Supprimer le quizz
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
}else{
    ?>
    <form action="../admin/test.php?id=<?=$_GET["id"]?>" method="POST" class="mt-5">

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
            <button id="submit" type="submit" class="btn btn-info">Modifier</button>
        </div>

    </form>
<?php
}
?>
<div class= "mt-5"></div>
</div>
<?php

require_once "footer.php";