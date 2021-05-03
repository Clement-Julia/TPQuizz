<?php
require_once "header.php";
$User = new Utilisateur($_SESSION["idUtilisateur"]);
$userAmis = $User->getAmis();
?>

<div id="bg-ami"></div>
<div id="container-ami" class="container d-flex flex-wrap justify-content-center mt-5">
    
        <?php
        foreach ( $userAmis as $ami ){
            $InfosAmi = new Utilisateur($ami->getIdUtilisateur2());
            ?>
            <div class="card card-ami col-12 col-md-3 my-2 mx-2">
                <div class="card-body d-flex">
                    <div class="avatar"><img src="../src/img/question.png" alt="" style="height:75px; width:75px;"></div>
                    <div><?=$InfosAmi->getPseudo();?></div>
                    <div><button class="btn-sm btn-outile-danger btn-ami"><i class="fas fa-times rouge"></i></button></div>
                </div>
            </div>
            <?php
        }
        ?>


</div>

<?php
require_once "footer.php";
?>