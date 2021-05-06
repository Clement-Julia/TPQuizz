<?php
require_once "header.php";

if ( !empty($_SESSION["idUtilisateur"]) ){

    $User = new Utilisateur($_SESSION["idUtilisateur"]);
    $userAmis = $User->getAmis();

    ?>

    <div id="bg-ami"></div>
    <form action="../traitements/supprimerAmis.php" method="POST">
        <div id="container-ami" class="container d-flex flex-wrap justify-content-center mt-5">
            
                <?php

                if ( !empty($_GET["success"]) ){
                    ?>
                    <div class="alert alert-success my-3 col-12 text-center">Ami(s) supprimé(s)</div>
                    <?php
                }
                if ( !empty($_GET["erreur"]) ){
                    ?>
                    <div class="alert alert-warning my-3 col-12 text-center">Une erreur s'est produite et les amis sélectionnés n'ont pas pu être retiré de votre liste d'amis</div>
                    <?php
                }
                if ( !empty($_GET["ami"]) ){
                    ?>
                    <div class="alert alert-success my-3 col-12 text-center">Ami ajouté ! :)</div>
                    <?php
                }
                if ( !empty($_GET["amiErreur"]) ){
                    ?>
                    <div class="alert alert-warning my-3 col-12 text-center">Aucun joueur ayant ce pseudo n'a été trouvé :/</div>
                    <?php
                }

                $i = 0;
                foreach ( $userAmis as $ami ){
                    ?>
                    <div class="card card-ami col-12 col-md-4 col-lg-3 my-2 mx-2">
                        <div class="card-body d-flex">
                            <div class="avatar"><img src="../src/img/question.png" alt=""></div>
                            <div><?=$ami->getUtilisateur2()->getPseudo();?></div>
                            <div>
                                <input id="inputCheckAmi<?=$i;?>" class="inputCheckAmi" type="checkbox" name="supprimer[]" value="<?=$ami->getUtilisateur2()->getIdUtilisateur();?>">
                                <label for="inputCheckAmi<?=$i;?>"></label>
                            </div>
                        </div>
                    </div>
                    <?php
                    $i++;
                }
                ?>


        </div>
        <div class="d-flex justify-content-center py-3">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Ajouter un ami</button>
            <input class="btn btn-sm btn-danger" type="submit" value="Retirer" disabled>
        </div>
    </form>


    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="ajoutAmi" aria-hidden="true">
        <div class="modal-dialog">
            <form action="../traitements/ajouterAmi.php" method="POST">
                <div class="modal-content ps-5">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ajoutAmi">Ajouter un ami</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            <label class="my-3" for="ami">Veuillez renseigner le pseudo de votre ami :</label>
                            <input id="ami" type="text" name="ami">
                        </div>
                        <div class="d-flex justify-content-end icon"><i class="fas fa-user-friends fa-10x"></i></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>



    <script>
        const submit = document.querySelector("input[type=submit]");
        const checkbox = document.querySelectorAll("input[type=checkbox]");
        var check = 0;
        checkbox.forEach(item => {
            item.addEventListener("click", () => {
                checkbox.forEach(item => {
                    if(item.checked){
                        check++;
                    }
                })
                if(check == 0){
                submit.disabled = true;
                } else {
                    submit.disabled = false;
                }
                check = 0;
            })
        })
    </script>

    <?php

} else {
    ?>
    <div class="alert alert-warning">Il faut être connecter afin de pouvoir consulter ses amis :)</div>
    <?php
}

require_once "footer.php";
?>