<?php
require_once "header.php";
require_once "../traitements/traitement.php";
require_once "../admin/sidebar.php";
?>

<?php
if ( isset($_GET["success"]) ){
    ?>
    <div class="alert alert-success container mt-3">La catégorie a bien été crée !</div>
    <?php
}
if ( isset($_GET["error"]) ){
    ?>
    <div class="alert alert-warning container mt-3">Une erreur est survenue pendant la création de la catgéorie :/</div>
    <?php
}
?>
<p class="text-muted text-center h2 my-5">Ajout d'une catégorie :</p>
<div class="container">
    <form method = "post" action="ajoutCategorie.php">
    <div class="mb-4">
        <label for="nom" class="form-label h5">Nom de la catégorie :</label>
        <input type="text" class="form-control" id="nom" name="nom">
    </div>
    <div class="mb-4">
        <label for="icone" class="form-label h5">Lien du logo :</label>
        <input type="text" class="form-control" id="icone" name="icone">
    </div>
    <div class="d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </div>
    </form>
</div>