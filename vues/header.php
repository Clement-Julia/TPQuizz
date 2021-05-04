<?php
require_once "../traitements/traitement.php";
if(!empty($_SESSION["role"])){
  if($_SESSION["role"] == 2){
    require_once "../admin/sidebar.php";
  }
}

$modele = new Categorie();
$Cats = $modele->toutesLesCategories();
$url = "/Exo/TPQuizz/vues/index.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <script src="https://kit.fontawesome.com/f3f16a7b72.js" crossorigin="anonymous"></script>
    <title>TPQuizz</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <div class="d-flex justify content start">
          <a class="navbar-brand" href="../vues/">Quiz</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../vues/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../vues/listeQuizz.php">Liste des Quiz</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../vues/ajouterQuizz.php">Créer Quizz</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="d-flex justify content center position-relative">
          <button type="button" class="btn dropdown-toggle dropdown-toggle-split radius over" data-bs-toggle="dropdown" aria-expanded="false" style ="width: 150px">
            Catégories 
            <span class="visually-hidden"></span>
          </button>
          <ul class="dropdown-menu">
            <?php
              foreach($Cats as $Cat){
                ?>
                <li><a class="dropdown-item" href="../vues/avantQuizz.php?categorie=<?=$Cat["idCategorie"]?>"><?=$Cat["libelle"]?></a></li>
                <?php
              }
            ?>
          </ul>
        </div>
        <div class="d-flex justify-content-end">  
          <form class="form-inline me-3" method="post" action="../traitements/redirection.php">
            <div class="recherche-barr">
              <input class="recherche-input" name="filtre" type="search" id="recherche" placeholder="Recherche" aria-label="Search" onclick="addClass()">
              <button type="submit" class="recherche-icone">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </form>
          <?=(!empty($_SESSION["idUtilisateur"]) ? "" : "<a href='inscription.php' class='btn-group btn btn-outline-primary btn-sm align-self-center ml-auto'>Inscription</a>");?>
          <?=(!empty($_SESSION["idUtilisateur"]) ? "<a href='../traitements/deconnexion.php' class='btn btn-outline-danger btn-sm align-self-center '>Déconnection</a>" : "<a href='connexion.php' class='btn btn-outline-success btn-sm align-self-center'>Connection</a>");?>
        </div>
      </div>
    </nav>