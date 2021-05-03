<?php
require_once "header.php";
require_once "../modeles/Modele.php";
require_once "../modeles/Quizz.php";

$Quizz = new Quizz();
$reponses = $Quizz->getValuesResultatQuizz($_GET["quizz"], 2);
$note = 0;
foreach ( $reponses as $reponse ){
    if( $reponse["reponse_utilisateur"] == $reponse["reponse"] ){
        $note++;
    }
}
if (!empty($_SESSION["idUtilisateur"]) ){
    $Score = new Score();
    $Score->updateScore($_SESSION["idUtilisateur"], $_GET["quizz"], $note);
}

?>
<div class="container mt-5">

    <div class="card">
        <div class="card-body">
            <div id="resultat_quizz_div_score" class="card-text py-3">
                <div id="resultat_quizz_score">
                    <div><?=$note;?>/10</div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                Résultats du quizz
                </button>
            </h2>

            <div id="collapseOne" class="accordion-collapse collapse show p-2" aria-labelledby="headingOne" data-bs-parent="#accordionExample">

            <?php
            $i = 1;
            foreach ( $reponses as $reponse ){
            ?>

                    <div class="accordion-body <?= $reponse["id_reponse_utilisateur"] == $reponse["idReponse"] ? "resultat-bg-rouge" : "resultat-bg-vert";?>">
                        <div class="py-1 light-bold">Question <?=$i;?> : </div>
                        <div class="py-1"><?=$reponse["description"];?></div>
                        <div class="py-1"><?= $reponse["id_reponse_utilisateur"] == $reponse["idReponse"] ? "Vous aviez trouvé la bonne réponse : " . $reponse["reponse_utilisateur"] : "Votre réponse était : " . $reponse["reponse_utilisateur"];?></div>
                        <?= $reponse["id_reponse_utilisateur"] == $reponse["idReponse"] ? "" : "<div class='py-1'>Mais la réponse correcte était : " . $reponse["reponse"] . "</div>";?>
                    </div>
                    <hr class="dropdown-divider my-1">

            <?php
            $i++;
            }
            ?>

            </div>

        </div>
    </div>

</div>

<?php
require_once "footer.php";
?>