<?php
require_once "header.php";
require_once "../traitements/traitement.php";
require_once "../admin/sidebar.php";

$modele = new Categorie();
$Cats = $modele->toutesLesCategories();

if(!empty($_GET["modif"])){
    $info = new Categorie($_GET["modif"]);
}

if(empty($_GET["modif"])){
    if ( !empty($_GET["success"]) && $_GET["success"] == 1){
        ?>
        <div class="alert alert-success container">La catégorie a bien été modifiée !</div>
        <?php
    }
    if ( !empty($_GET["success"]) && $_GET["success"] == 2){
        ?>
        <div class="alert alert-success container">La catégorie a bien été suppression !</div>
        <?php
    }
    if ( !empty($_GET["error"]) && $_GET["error"] == "exist"){
        ?>
        <div class="alert alert-warning container">La catégorie ne peut pas être supprimée tant que des quizz sont lié à celle-ci :/</div>
        <?php
    }if(!empty($_GET["error"])){
        ?>
        <div class="alert alert-warning container">Une erreur est survenue pendant la modification de la catégorie :/</div>
        <?php
    }
    ?>
    <p class="text-muted text-center h1 my-5">Liste des catégories :</p>
    <?php
    foreach($Cats as $cat){
        ?>
        <div class ="d-flex justify-content-center">
            <div class="container_intro mt-4" style="max-width: 650px">
                <div class="row">
                    <div class="col-md-6 col-xl-7 sep-md col_quiz_intro" style="max-width:400px; height:200px">
                        <div class="d-flex align-items-center h-100">
                            <img class="quiz_img radius-md" src="<?=$cat["icone"]?>" >
                        </div>
                    </div>
                    <div class="col-md-6 col-xl-5 col_quiz_intro">
                        <div class="d-md-flex align-items-center h-100">
                            <div>
                                <h2 class="quiz_title mb-3 text-center">
                                    <span class="sn_pencil" data-sn_uid="1454"><?=$cat["libelle"]?></span>
                                </h2>
                                <div class="d-flex justify-content-center mt-5">
                                    <a href="modifierCat.php?modif=<?=$cat["idCategorie"]?>" class="btn_quiz btn btn-warning">
                                        Modifier
                                    </a>
                                    <a href="supCat.php?id=<?=$cat["idCategorie"]?>" class="btn_quiz btn btn-danger">
                                        Supprimer
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5"></div>
        <?php
    }
}else{
    ?>
    <p class="text-muted text-center h2 my-5">Modification d'une catégorie :</p>
    <div class="container">
        <form method = "post" action="">
            <div class="mb-4">
                <label for="nom" class="form-label h5">Nom de la catégorie :</label>
                <input type="text" class="form-control" id="nom" value="<?=$info->getLibelle()?>">
            </div>
            <div class="mb-4">
                <label for="logo" class="form-label h5">Lien du logo :</label>
                <input type="text" class="form-control" id="logo" value="<?=$info->getIcone()?>">
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
        </form>
    </div>
    <?php
}