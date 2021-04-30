<?php
require_once "header.php";
require_once "../traitements/traitement.php";
require_once "../vues/container.php";

$questionS = new QuestionSecrete();
$questionSecretes = $questionS->getAllQuestions();


$erreurs = ["L'email saisi est déjà utilisée", "Les deux mots de passe ne sont pas identiques", "L'âge doit être compris entre 0 et 120 ans", "Au moins un des champs n'a pas été saisi", "Le mot de passe doit contenir au moins 1 minuscule.", "Le mot de passe doit contenir au moins 1 majuscule.", "Le mot de passe doit contenir au moins 1 chiffre.", "Le mot de passe doit contenir au moins 1 caractère spécial.", "Le mot de passe doit contenir au moins 8 caractères.", "L'image existe déjà", "L'image est trop large (> 500ko)", "Seulement les fichiers de types JPG, JPEG, PNG sont autorisés"];

if(!empty($_GET["err"])){
    ?>
    <div class="alert alert-warning">
        <?php
        $tableau = preg_split("#[,]#", $_GET["nb"]);
        for($i = 0; $i < count($erreurs); $i++){
            if(isset($tableau[$i])){
                echo $erreurs[$tableau[$i]] . "<br>";
            }
        }
        ?>
    </div>
    <?php
}

if(isset($_GET["error"])){
    ?>
    <div class="alert alert-danger">
        Une erreur s'est produite lors de l'inscription
    </div>
    <?php
}

?>

<h1>Formulaire d'inscription :</h1>
<form method="POST" action = "../traitements/inscription.php">

    <div class="form-group my-3">
        <label for="identifiant" class="mb-1">Identifiant : </label>
        <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="Entrez votre identifiant" required>
    </div>

    <div class="form-group my-3">
        <label for="mdp" class="mb-1">Mot de passe : </label>
        <input type="password" class="form-control" name="mdp" id="mpd" placeholder="Entrez votre mot de passe" required>
    </div>

    <div class="form-group my-3">
        <label for="mdpVerif" class="mb-1">Vérification du mot de passe : </label>
        <input type="password" class="form-control" name="mdpVerif" id="mdpVerif" placeholder="Vérifier votre mot de passe" required>
    </div>

    <div class="form-group my-3">
        <label for="email" class="mb-1">Email : </label>
        <input type="email" class="form-control" name="email" id="email" placeholder="Entrez votre email" required>
    </div>

    <div class="form-group my-3">
        <label for="questionS" class="mb-1">Question secrète : </label>
        <SELECT class="form-control" name="questionS" id="questionS"  required>
            <option value="0" selected hidden>Choisissez votre question secrète</option>
            <?php
            for($x = 0; $x < count($questionSecretes); $x++){
                ?>
                <option value="1"><?=$questionSecretes[$x]?></option>
                <?php
            }
            ?>
        </select>
    </div>

    <div class="form-group my-3">
        <label for="reponseS" class="mb-1">Réponse secrète : </label>
        <input type="text" class="form-control" name="reponseS" id="reponseS" placeholder="Votre réponse secrète">
    </div>

    <div class="form-group btn-group mt-3">
        <button type="submit" class="btn btn-primary" name="submit" value="ON">Inscription</button>
        <a href="../vues/" class="btn btn-warning">Retour</a>
    </div>

</form>

<?php
require_once "footer.php";
?>