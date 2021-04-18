<?php
require_once "../Modele/modele.php";
$url = "http://localhost/Exo/TPQuizz/vues/";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/styles.css">
    <link rel="stylesheet" type="text/css" href="../css/test.css">
    <script src="https://kit.fontawesome.com/f3f16a7b72.js" crossorigin="anonymous"></script>
    <title>TPQuizz</title>
  </head>

  <body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
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
        <!-- <div class="ml-auto mr-auto">
          <button type="button" class="btn button-destination dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
            Catégorie 
            <span class="visually-hidden"></span>
          </button>
          <ul class="dropdown-menu">
            <li class="dropdown-item disabled">Les plus populaires :</li>
            <li><hr class="dropdown-divider"></li>
            <?php
              foreach($famous as $fam){
                ?>
                <li><a class="dropdown-item mr-5" href="tours.php?idTour=<?=$fam["idVoyage"]?>"><?=$fam["libelle"]?><span class="badge bg-transparent" style="position: absolute; right:0%"><?=round($fam["note"], 1)?><i class="fas fa-star"></i></span></a></li>
                <?php
              }
            ?>
          </ul>
        </div> -->
        <?=(!filter_var($url, FILTER_VALIDATE_URL) === true ? "" : "<button type='button' class='btn btn-primary radius'>Catégorie <i class='fas fa-caret-down'></i></button>")?>
        <?=(!empty($_SESSION["idUtilisateur"]) ? "" : "<a href='inscription.php' class='btn-group btn btn-outline-primary btn-sm align-self-center ml-auto'>Inscription</a>");?>
        <?=(!empty($_SESSION["idUtilisateur"]) ? "<a href='../traitements/deconnexion.php' class='btn btn-outline-danger btn-sm align-self-center '>Déconnection</a>" : "<a href='connexion.php' class='btn btn-outline-success btn-sm align-self-center'>Connection</a>");?>
      </div>
    </nav>
    <div class="container">