<?php
require_once "header.php";
$Quizz = new Quizz();
$infos = $Quizz->quizzParCategorie($_GET["filtre"]);

if ( count($infos) > 0 ){

?>
<div class="container d-flex">
<?php
foreach ( $infos as $info ){
    ?>
        <div class="card my-5 mx-3 card-affichage-quizz">
            <img src="<?=!empty($info["logo"]) ? $info["logo"] : "../src/img/question.png";?>" class="card-img-top" alt="...">
            <div class="card-body text-center">
                <p class="card-text"><a class="lienAffichageQuizz" href="quizz.php?quizz=<?=$info["idQuizz"];?>"><?=$info["titre"];?></a></p>
            </div>
        </div>
    <?php
}
?>
</div>
<?php
} else {
    ?>
    <div class="alert alert-warning my-5">Malheureusement il n'y a pas encore de quizz pour cette catégorie :/</div>
    <?php
}
?>

<?php
require_once "footer.php";
?>