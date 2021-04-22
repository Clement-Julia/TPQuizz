<?php
require_once "header.php";

$modele = new Modele();

if(isset($_SESSION["idUtilisateur"]) && empty($_SESSION["idUtilisateur"])){
    session_destroy();
}

$req = $modele->getBdd()->prepare("SELECT libelle, icone from categories");
$req->execute();
$Cats = $req->FetchAll(PDO::FETCH_ASSOC);
?>

<div class="d-flex alert alert-secondary mt-3 py-3">
    Explorez les catégories ou visualisez tous les quizz !
    <a href="listeQuizz.php" class="ml-auto"><button class="btn btn-primary">
        Voir tous les quizz <i class="fas fa-chevron-right"></i>
    </button></a>
</div>

<div class="mt-5 text-center">
    <b style ="font-size:25px">Explorez les plus populaires :</b>
</div>
<div class="d-flex justify-content-center mt-3">
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

<div class="mt-5 text-center">
    <b style ="font-size:25px">Explorez par Catégories :</b><br><br>
    <?php
    foreach($Cats as $Cat){
        ?>
        <div style="width:25%; display:inline-block; margin: 0 20px;" class="mb-4">
            <a href="quizz.php?filtre=<?=$Cat["libelle"]?>"><button class="btn btn-grey mr-3 py-3 pl-0 pr-3 radius-md policies" style="min-width: 230px;">
                <img src="<?=$Cat["icone"]?>" style="width:30px; height:30px;" HSPACE="15">
                <?=$Cat["libelle"]?>
            </button></a>
        </div>
        <?php
    }
    ?>
</div>


<?php
require_once "footer.php";
?>