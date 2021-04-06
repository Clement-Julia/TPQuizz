<?php
require_once "header.php";
?>

<div id="bg-quizz"></div>
<div class="container pt-5">

    <div class="row d-flex justify-content-center mt-5">
        <div class="card col-12 col-lg-6 card-quizz">
            <div class="card-body">
                <div class="card-text text-center py-2 card-text-header">Catégorie</div>
                <hr class="dropdown-divider">
                <div class="card-text">Voici l'exemple d'une question pour voir ce que ça donne au niveau du design, rien de plus, rien de moins, juste une peu de paillette dans ta vie ?</div>
                <hr class="dropdown-divider">
                <div class="card-text py-2">
                    <div class="input-group">
                        <form method="post" action="">
                            
                            <div class="global-ratio-container my-3">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="quizz" value="">
                                </div>
                                <div class="">Réponse 1, la réponse est pas la plus belle mais c'est sur qu'on salut l'effort</div>
                            </div>

                            <div class="global-ratio-container my-3">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="quizz" value="">
                                </div>
                                <div class="">Réponse 2, la réponse est pas la plus belle mais c'est sur qu'on salut l'effort</div>
                            </div>

                            <div class="global-ratio-container my-3">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="quizz" value="">
                                </div>
                                <div class="">Réponse 3, la réponse est pas la plus belle mais c'est sur qu'on salut l'effort</div>
                            </div>

                            <div class="global-ratio-container my-3">
                                <div class="ratio-container">
                                    <input class="ratio" type="radio" name="quizz" value="">
                                </div>
                                <div class="">Réponse 4, la réponse est pas la plus belle mais c'est sur qu'on salut l'effort</div>
                            </div>

                            <div class="text-center pt-4">
                                <button class="btn-validate" type="submit" name="validate"><i class="fas fa-check"></i></button>
                            </div>

                        </form>
                    </div>
                </div>
                <hr class="dropdown-divider">
                <div class="card-text text-center text-muted py-2 card-text-footer">Designed By user01526</div>
            </div>
        </div>
    </div>

</div>


<?php
require_once "footer.php";
?>