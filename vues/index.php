<?php
require_once "header.php";
require_once "../Modele/modele.php";

$modele = new Modele();

if(empty($_SESSION["idUtilisateur"])){
    session_destroy();
}

$req = $modele->getBdd()->prepare("SELECT libelle from categories");
$req->execute();
$Cats = $req->FetchAll(PDO::FETCH_ASSOC);
?>

<div class="alert alert-secondary mt-3">
    Explorez les catégories ou visualisez tous les quizz !
    <button class="btn btn-primary" style="position: absolute; right:2%; bottom:10%">
        Voir tous les quizz <i class="fas fa-chevron-right"></i>
    </button>
</div>

<div class="d-flex justify-content-center mt-5">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img class="d-block carousel" src="https://ahaslides.com/wp-content/uploads/2020/04/cover-1024x578.png" alt="First slide">
            </div>
            <div class="carousel-item">
            <img class="d-block carousel" src="https://image.freepik.com/vecteurs-libre/theme-fond-neons_52683-44625.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
            <img class="d-block carousel" src="https://phototrend.fr/wp-content/uploads/2014/12/jpeg-1-759x500.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="mt-4 text-center">
    <b>Ou explorer par catégorie :</b><br><br>
    <?php
    foreach($Cats as $Cat){
        ?>
        <button class="btn btn-secondary">
            <?=$Cat["libelle"]?>
        </button>
        <?php
    }
    ?>
</div>


<?php
require_once "footer.php";
?>