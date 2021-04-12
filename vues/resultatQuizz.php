<?php
require_once "header.php";
require_once "../modeles/Modele.php";
require_once "../modeles/Quizz.php";

$Quizz = new Quizz();
$rapportQuizz = $Quizz->getValuesResultatQuizz($_GET["quizz"]);
echo "<pre>";
print_r($rapportQuizz);
echo "</pre>";
?>

<div class="container mt-5">

    <div class="card">
        <div class="card-body">
            <div id="resultat_quizz_div_score" class="card-text py-3">
                <div id="resultat_quizz_score">
                    <div>9/10</div>
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


            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div>LA QUESTION</div>
                    <div>LA REPONSE DU JOUEUR</div>
                    <div>LA REPONSE EXACT SI LE JOUEUR A EU FAUX</div>
                </div>
            </div>

            <hr class="dropdown-divider">

            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <div>LA QUESTION</div>
                    <div>LA REPONSE DU JOUEUR</div>
                    <div>LA REPONSE EXACT SI LE JOUEUR A EU FAUX</div>
                </div>
            </div>


        </div>
    </div>

</div>

<?php
require_once "footer.php";
?>