<?php
require_once "header.php";

$categorie = new Categorie();
$categories = $categorie->toutesLesCategories();
?>

<div class="container mt-5">

    <?php
    if ( !empty($_GET["success"]) ){
        ?>
        <div class="alert alert-success">Le Quizz a bien été crée !</div>
        <?php
    }
    if ( !empty($_GET["error"]) ){
        ?>
        <div class="alert alert-warning">Une erreur est survenue pendant la création du quizz :/</div>
        <?php
    }

    ?>

    <h1 class="text-center my-4">Créer un Quizz</h1>

    <form action="../traitements/test.php" method="POST">

        <div class="input-group mb-3">
            <span class="input-group-text input-group-text-default-size" id="inputGroup-sizing-default">Catégorie</span>
            <select class="form-select" name="categorie" aria-label="Default select example">
                <option selected hidden disabled>Open this select menu</option>
                <?php
                foreach ( $categories as $catgorie ){
                ?>
                <option value="<?=$catgorie["idCategorie"];?>"><?=$catgorie["libelle"];?></option>
                <?php
                }
                ?>
            </select>
        </div>

        <div class="input-group mb-3">
            <span class="input-group-text input-group-text-default-size" id="inputGroup-sizing-default">Titre du Quiz</span>
            <input type="text" class="form-control" name="titre" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <hr class="dropdown-divider my-5">

        <?php
        for ( $i = 0; $i < 10; $i++ ){
        ?>

        <div class="input-group mb-3">
            <span class="input-group-text input-group-text-default-size" id="inputGroup-sizing-default">Question N°<?=$i+1;?></span>
            <input type="text" class="form-control" name="question[<?=$i;?>][question]" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>

        <div class="input-group my-2">
            <div class="input-group-text">
                <input class="form-check-input mt-0" type="hidden" name="question[<?=$i;?>][reponses][0][vrai]" value="1" aria-label="Radio button for following text input">
            </div>
            <input type="text" class="form-control input-success" name="question[<?=$i;?>][reponses][0][reponse]" aria-label="Text input with radio button" placeholder="La réponse correcte">
        </div>

        <div class="input-group my-2">
            <div class="input-group-text">
                <input class="form-check-input mt-0" type="hidden" name="question[<?=$i;?>][reponses][1][vrai]" value="0" aria-label="Radio button for following text input">
            </div>
            <input type="text" class="form-control" name="question[<?=$i;?>][reponses][1][reponse]" aria-label="Text input with radio button" placeholder="réponse 2">
        </div>

        <div class="input-group my-2">
            <div class="input-group-text">
                <input class="form-check-input mt-0" type="hidden" name="question[<?=$i;?>][reponses][2][vrai]" value="0" aria-label="Radio button for following text input">
            </div>
            <input type="text" class="form-control" name="question[<?=$i;?>][reponses][2][reponse]" aria-label="Text input with radio button" placeholder="réponse 3">
        </div>

        <div class="input-group my-2">
            <div class="input-group-text">
                <input class="form-check-input mt-0" type="hidden" name="question[<?=$i;?>][reponses][3][vrai]" value="0" aria-label="Radio button for following text input">
            </div>
            <input type="text" class="form-control" name="question[<?=$i;?>][reponses][3][reponse]" aria-label="Text input with radio button" placeholder="réponse 4">
        </div>

        <hr class="dropdown-divider my-5">

        <?php
        }
        ?>

        <div class="d-flex justify-content-center mb-5">
            <button id="submit" type="submit" class="btn btn-info">Créer</button>
        </div>

    </form>
</div>


<?php
require_once "footer.php";
?>