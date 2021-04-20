<?php
require_once "header.php";
require_once "../Modele/modele.php";
$modele = new Modele();

$explode = explode(" ", $_GET["filtre"]);
$repet = [];

for($x = 0; $x < count($explode); $x++){
    $repet[] = "titre LIKE '%$explode[$x]%' OR ";
}
$implode = implode(" ", $repet);
$implode = substr($implode, 0, -4);

$sql = "SELECT * from quizz where $implode";

$req = $modele->getBdd()->prepare($sql);
$req->execute();
$quizz = $req->fetch(PDO::FETCH_ASSOC);
?>

<?php
if(!empty($quizz) && !empty($_GET["filtre"])){
    ?>
    <div class="container_intro mt-5">
        <div class="row">
            <div class="col-md-6 col-xl-7 sep-md col_quiz_intro" style="max-width:400px; height:200px">
                <div class="d-flex align-items-center h-100">
                    <img class="quiz_img radius-md" src="<?=$quizz["logo"]?>" >
                </div>
            </div>
            <div class="col-md-6 col-xl-5 col_quiz_intro">
                <div class="d-md-flex align-items-center h-100">
                    <div>
                        <h2 class="quiz_title mb-3 text-center">
                            <span class="sn_pencil" data-sn_uid="1454"><?=$quizz["titre"]?></span>
                        </h2>
                        <div class="quiz_desc">
                            <span class="sn_pencil" data-sn_uid="1455">Les questions s'affichent dans un ordre aléatoire. Vous ferez de nouvelles découvertes à chaque fois!</span>
                        </div>
                        <div class="d-flex justify-content-center mt-5">
                            <a href="#" class="btn_quiz btn btn-primary">
                                LANCER LE QUIZ
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}else {
    ?>
    <p class="text-muted text-center h1 my-5">Aucun quizz n'a été trouvé :(</p>
    <?php
}




require_once "footer.php";