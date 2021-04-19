<?php
require_once "../Modele/modele.php";
$modele = new Modele();
$url = "/Exo/TPQuizz/vues/index.php";
$req = $modele->getBdd()->prepare("SELECT libelle from categories");
$req->execute();
$Cats = $req->FetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
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
                <a class="nav-link" href="#">Liste des Quiz</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="d-flex justify content center position-relative">
          <?php
          if($_SERVER['PHP_SELF'] === $url){
            ?>
            <button type="button" class="btn dropdown-toggle dropdown-toggle-split radius over" data-bs-toggle="dropdown" aria-expanded="false" style ="width: 150px">
              Catégories 
              <span class="visually-hidden"></span>
            </button>
            <?php
          }
          ?>
          <ul class="dropdown-menu">
            <?php
              foreach($Cats as $Cat){
                ?>
                <li><a class="dropdown-item" href="quizz.php?filtre=<?=$Cat["libelle"]?>"><?=$Cat["libelle"]?></a></li>
                <?php
              }
            ?>
          </ul>
        </div>
        <div class="d-flex justify-content-end">  
          <form class="form-inline mr-3" method="post">
            <div class="recherche-barr">
              <input class="recherche-input" name="filtre" type="search" placeholder="Recherche" aria-label="Search">
              <a href="#" class="recherche-icone">
                <i class="fas fa-search"></i>
              </a>
            </div>
          </form>
          <?=(!empty($_SESSION["idUtilisateur"]) ? "" : "<a href='inscription.php' class='btn-group btn btn-outline-primary btn-sm align-self-center ml-auto'>Inscription</a>");?>
          <?=(!empty($_SESSION["idUtilisateur"]) ? "<a href='../traitements/deconnexion.php' class='btn btn-outline-danger btn-sm align-self-center '>Déconnection</a>" : "<a href='connexion.php' class='btn btn-outline-success btn-sm align-self-center'>Connection</a>");?>
        </div>
      </div>
    </nav>
    <div class="container">