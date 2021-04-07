<?php
require_once "header.php";

$requete = getBdd()->prepare("SELECT idQuizz, titre, libelle, idQuestion, idUtilisateur, description, idReponse, reponse FROM quizz LEFT JOIN questions USING(idQuizz) LEFT JOIN reponses_quizz USING(idQuestion) LEFT JOIN categories USING(idCategorie) WHERE idQuizz = ?");
$requete->execute([1]);
$donnees = $requete->fetchAll(PDO::FETCH_ASSOC);

$positionDonnéePrincipale = 0;
$temp = 0;
$colonne = 0;
$carteQuizz = [];

while($temp < 40){

    if($temp == 0 || $temp % 4 == 0){
        $carteQuizz[$colonne] = [
            'idQuizz' => $donnees[$positionDonnéePrincipale]['idQuizz'],
            'titre' => $donnees[$positionDonnéePrincipale]['titre'],
            'libelle' => $donnees[$positionDonnéePrincipale]['libelle'],
            'idQuestion' => $donnees[$positionDonnéePrincipale]['idQuestion'],
            'idUtilisateur' => $donnees[$positionDonnéePrincipale]['idUtilisateur'],
            'description' => $donnees[$positionDonnéePrincipale]['description']
        ];
        $colonne = $colonne + 1;
    }
    
    $carteQuizz[($colonne - 1)]['reponses'][] = $donnees[$temp]['reponse'];

    $temp = $temp + 1;
    if($temp != 0 && $temp % 4 == 0){
        $positionDonnéePrincipale = $positionDonnéePrincipale + 4;
    }
    
}

// echo "<pre>";
// print_r($carteQuizz);
// echo "</pre>";

?>

<div id="bg-quizz"></div>
<div class="container pt-5">

    <form id="form-quizz" method="post" action="../traitements/quizz.php">

    <div id="card-container" class="row d-flex justify-content-center mt-5">

<?php
$id = 1;
$zIndex = 10;
foreach($carteQuizz as $carte){

    // echo "<pre>";
    // print_r($carte);
    // echo "</pre>";
?>

        <div id="<?=$id?>" class="card col-12 col-lg-6 card-quizz is-not-visible" style="z-index:<?=($zIndex - $id)?>;">
            <div class="card-body">
                <div class="card-text py-2 card-text-header d-flex justify-content-center"><div><?=$carte["titre"]?></div><div id="timer-<?=$id?>" class="timer">timer</div></div>
                <hr class="dropdown-divider">
                <div class="card-text">Question <?=$id?> : <br><?=$carte["description"]?></div>
                <hr class="dropdown-divider">
                <div class="card-text py-2">
                    <div class="input-group d-flex flex-column">

                            <input class="is-not-visible" type="checkbox" name="question-<?=$id?>" value="0" checked>
                            <div class="global-ratio-container my-2">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="question-<?=$id?>" value="1">
                                </div>
                                <div class=""><?=$carte["reponses"][0]?></div>
                            </div>

                            <div class="global-ratio-container my-2">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="question-<?=$id?>" value="2">
                                </div>
                                <div class=""><?=$carte["reponses"][1]?></div>
                            </div>

                            <div class="global-ratio-container my-2">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="question-<?=$id?>" value="3">
                                </div>
                                <div class=""><?=$carte["reponses"][2]?></div>
                            </div>

                            <div class="global-ratio-container my-2">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="question-<?=$id?>" value="4">
                                </div>
                                <div class=""><?=$carte["reponses"][3]?></div>
                            </div>

                            <div class="text-center pt-4 validate-container">
                                <button type="<?=$id == 10 ? "submit" : "button"?>" id="btn-<?=$id?>" class="btn-validate" name="validate"><i class="fas fa-check"></i></button>
                            </div>

                    </div>
                </div>
                <hr class="dropdown-divider">
                <div class="card-text text-center text-muted py-2 card-text-footer">Designed By user01526</div>
            </div>
        </div>
<?php
$id++;
}
?>

    </div>
    </form>

</div>

<script src="../js/script.js"></script>

<?php
require_once "footer.php";
?>