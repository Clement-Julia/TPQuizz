<?php
require_once "header.php";
require_once "../modeles/Modele.php";
require_once "../modeles/Quizz.php";

?>

<div id="bg-quizz"></div>

<div class="container pt-5">

    <form id="form-quizz" method="post" action="../traitements/quizz.php">

    <div id="card-container" class="row d-flex justify-content-center mt-5">


        <div id="0" class="card col-12 col-lg-6 card-quizz" style="z-index: 20;">
                <div class="card-body">
                    <div id="start-header" class="card-text py-2 card-text-header d-flex justify-content-center"></div>
                    <hr class="dropdown-divider">
                    <div id="" class="card-text"><b>Règles :</b>  <br>Vous allez devoir répondre à 10 questions possédant chacune 4 réponses possibles. <br>Vous disposerez de 20 secondes pour chaque carte afin d'y répondre.</div>
                    <hr class="dropdown-divider">
                    <div class="card-text py-2">
                        <div class="input-group d-flex flex-column">

                            <div class="text-center validate-container">
                                <button type="button" class="btn-validate" name="validate"><i class="fas fa-check"></i></button>
                            </div>

                        </div>
                    </div>
                    <hr class="dropdown-divider">
                    <div class="designed-by card-text text-center text-muted py-2 card-text-footer">Designed By user01526</div>
                </div>
            </div>


<?php
$id = 1;
$zIndex = 10;
for($i = 1; $i < 11; $i++){

?>

        <div id="<?=$id?>" class="card col-12 col-lg-6 card-quizz is-not-visible" style="z-index:<?=($zIndex - $id)?>;">
            <div class="card-body">
                <div class="card-text py-2 card-text-header d-flex justify-content-center"><div id="titre-<?=$id;?>"></div><div id="timer-<?=$id?>" class="timer">timer</div></div>
                <hr class="dropdown-divider">
                <div id="question-<?=$id;?>" class="card-text"></div>
                <hr class="dropdown-divider">
                <div class="card-text py-2">
                    <div class="input-group d-flex flex-column">

                            <input class="is-not-visible" type="checkbox" name="question-<?=$id?>" value="0" checked>
                            <div class="global-ratio-container my-2">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="question-<?=$id?>" value="1">
                                </div>
                                <div id="reponse-1-<?=$id;?>"></div>
                            </div>

                            <div class="global-ratio-container my-2">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="question-<?=$id?>" value="2">
                                </div>
                                <div id="reponse-2-<?=$id;?>"></div>
                            </div>

                            <div class="global-ratio-container my-2">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="question-<?=$id?>" value="3">
                                </div>
                                <div id="reponse-3-<?=$id;?>"></div>
                            </div>

                            <div class="global-ratio-container my-2">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="question-<?=$id?>" value="4">
                                </div>
                                <div id="reponse-4-<?=$id;?>"></div>
                            </div>

                            <div class="text-center pt-4 validate-container">
                                <button type="<?=$id == 10 ? "submit" : "button"?>" id="btn-<?=$id?>" class="btn-validate" name="validate"><i class="fas fa-check"></i></button>
                            </div>

                    </div>
                </div>
                <hr class="dropdown-divider">
                <div class="designed-by card-text text-center text-muted py-2 card-text-footer">Designed By user01526</div>
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