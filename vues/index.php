<?php
require_once "header.php";
require_once "../traitements/traitement.php";
require_once "../vues/container.php";

$modele = new Modele();

$modele = new Categorie();
$Cats = $modele->toutesLesCategories();

$meilleursJoueurs = $modele->meilleurJoueurCats();

?>

<div id="bg-accueil"></div>

<div class="d-flex alert mt-3 py-3 alert-accueil">
    Explorez les catégories ou visualisez tous les quizz !
    <a href="listeQuizz.php" class="ms-auto"><button class="btn btn-accueil">
        Voir tous les quizz <i class="fas fa-chevron-right"></i>
    </button></a>
</div>

<div class="mt-5 text-center">
    <b style ="font-size:25px">Explorez les plus populaires :</b>
</div>
<div class="d-flex justify-content-center mt-3">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $i = 0;
            foreach ( $Cats as $cat ){
                ?>
                <div class="carousel-item <?=$i == 0 ? "active" : "";?>">
                    <img class="d-block carousel" src="../src/img/winner.jpg" alt="First slide">
                    <div class="carousel-item-text">
                        Catégorie <?=$cat["libelle"];?> : <br><br>
                        <?php
                        if ( !empty($meilleursJoueurs[$cat["libelle"]]["pseudo"]) ){
                            if ( count($meilleursJoueurs[$cat["libelle"]]["pseudo"]) > 1 ){
                                echo "Meilleures moyennes : <br><br>";
                                $i = 0;
                                foreach ( $meilleursJoueurs[$cat["libelle"]]["pseudo"] as $pseudo ){
                                    echo "- " . $pseudo . " avec " . number_format($meilleursJoueurs[$cat["libelle"]]["moyenne"][$i], 1, ",", "") . " pts<br>";
                                    $i++;          
                                }
                            } else {
                                echo "Meilleure moyenne : <br><br> - " . $meilleursJoueurs[$cat["libelle"]]["pseudo"][0] . " avec " . number_format($meilleursJoueurs[$cat["libelle"]]["moyenne"][0], 1, ",", "") . " pts";
                            }
                        } else {
                            echo "pas encore de meilleur moyenne !<br> A vous de jouer :)";
                        }
                        ?>
                    </div>
                </div>
            <?php
            $i++;
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>

<div class="mt-5 text-center">
    <b style ="font-size:25px">Explorez par Catégories :</b><br><br>
    <div class="d-flex justify-content-center row">
    <?php
    foreach($Cats as $Cat){
        ?>
        <div class="mb-4 col-12 col-md-4 col-lg-3">
            <a class="btn btn-cat alert-accueil text-dark radius-md d-flex justify-content-center" href="../vues/avantQuizz.php?categorie=<?=$Cat["idCategorie"]?>">
                <img src="<?=$Cat["icone"]?>" style="width:30px; height:30px;" HSPACE="15">
                <?=$Cat["libelle"]?>
            </button></a>
        </div>
        <?php
    }
    ?>
    </div>
</div>


<?php
require_once "footer.php";
?>