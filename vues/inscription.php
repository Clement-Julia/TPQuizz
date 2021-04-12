<?php
require_once "header.php";
require_once "../Modele/modele.php";

$erreurs = ["L'email saisi est déjà utilisée", "Les deux mots de passe ne sont pas identiques", "L'âge doit être compris entre 0 et 120 ans", "Au moins un des champs n'a pas été saisi", "Le mot de passe doit contenir au moins 1 minuscule.", "Le mot de passe doit contenir au moins 1 majuscule.", "Le mot de passe doit contenir au moins 1 chiffre.", "Le mot de passe doit contenir au moins 1 caractère spécial.", "Le mot de passe doit contenir au moins 8 caractères.", "L'image existe déjà", "L'image est trop large (> 500ko)", "Seulement les fichiers de types JPG, JPEG, PNG sont autorisés"];

if(empty($_SESSION["idUtilisateur"])){
    session_destroy();
}

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

    <div class="form-group">
        <label for="identifiant">Identifiant : </label>
        <input type="text" class="form-control" name="identifiant" id="identifiant" placeholder="Entrez votre identifiant" required>
    </div>

    <div class="form-group">
        <label for="mdp">Mot de passe : </label>
        <input type="password" class="form-control" name="mdp" id="mpd" placeholder="Entrez votre mot de passe" required>
    </div>

    <div class="form-group">
        <label for="mdpVerif">Vérification du mot de passe : </label>
        <input type="password" class="form-control" name="mdpVerif" id="mdpVerif" placeholder="Vérifier votre mot de passe" required>
    </div>

    <div class="form-group">
        <label for="email">Email : </label>
        <input type="email" class="form-control" name="email" id="age" placeholder="Votre email" required>
    </div>

    <div class="form-group text-center btn-group d-flex justify-content-center mt-4">
        <a href="mdpOublier"><button type="button" class="btn btn-primary radius">
            <span>Mot de passe oublié ?</span> 
        </button></a>
    </div>

    <div class="form-group text-center btn-group d-flex justify-content-center mt-5">
        <button type="submit" class="btn btn-primary" name="submit" value="ON">Inscription</button>
        <a href="../vues/" class="btn btn-warning">Retour</a>
    </div>

</form>

<?php
require_once "footer.php";
?>