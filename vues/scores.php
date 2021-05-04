<?php
require_once "header.php";
$User = new Utilisateur($_SESSION["idUtilisateur"]);
$scores = $User->getScore();
$scoreAmis = $User->getScoreAmis();

// echo "<pre>";
// print_r($scoreAmis);
// echo "</pre>";

?>
<div id="bg-score"></div>
<div id="container-score" class="container py-2 my-2">

    <div class="card card-header-score">
        <div class="card-body text-center">
            Total de Quizz joués : <?=count($scores);?>
        </div>
    </div>

    <div class="row">
        <?php
        foreach ( $scores as $score ){
            $Q = new Quizz();
            $infoQ = $Q->getInfoQuizz($score->getIdQuizz());
            ?>

        <div class="card col-12 col-md-3 mx-2 my-3 p-0 card-score">
            <div class="card-header text-center card-header-score"><?=$infoQ["libelle"];?></div>
            <div class="card-body">
                <div class="row">
                    <h5 class="card-title col-6"><?=$infoQ["titre"];?></h5>
                    <div class="card-text col-6 scores-php"> <?=$score->getScore();?> / 10</div>
                </div>
                <hr class="dropdown-divider">
                <div style="height:18rem; overflow:auto;">
                <table class="table table-score">
                    <thead>
                        <th>Amis</th>
                        <th>Score</th>
                    </thead>
                <?php
                foreach ($scoreAmis as $ami ){
                    
                    if( $infoQ["idQuizz"] == $ami["idQuizz"] ){
                        $NewUser = new Utilisateur($ami["idUtilisateur"]);
                        $nomUser = $NewUser->getPseudo();
                        ?>
                        <tbody>
                            <?php
                            if ( $score->getScore() > $ami["score"] ){
                                ?>
                                <tr class="table-danger">
                                    <td><?=$nomUser;?></td>
                                    <td class="d-flex justify-content-between"><?=$ami["score"];?>
                                    <span class='ms-auto inf'>▼</span>
                                </tr>
                                <?php
                            } else if ( $score->getScore() < $ami["score"] ){
                                ?>
                                <tr class="table-success">
                                    <td><?=$nomUser;?></td>
                                    <td class="d-flex justify-content-between"><?=$ami["score"];?>
                                    <span class='ms-auto sup'>▲</span>
                                </tr>
                                <?php
                            } else {
                                ?>
                                <tr class="table-secondary">
                                    <td><?=$nomUser;?></td>
                                    <td class="d-flex justify-content-between"><?=$ami["score"];?>
                                    <span class='ms-auto egal'>=</span>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                        <?php
                    }
                        
                }
                ?>
                </table>
                </div>
            </div>
        </div>

        <?php
        }
        ?>

    </div>

<?php
require_once "footer.php";
?>