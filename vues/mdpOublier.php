<?php
require_once "header.php";
require_once "../Modele/modele.php";
require_once "../Modele/MdpOublier.php";
if(!empty($_SESSION["email"])){
  $mdpOublier = new Mdp($_SESSION["email"]);
  foreach($mdpOublier->getQuestion($_SESSION["email"]) as $ontest){
    $test = $ontest["question"];
  }
}
?>

<?php
if(empty($_GET["status"])){
  ?>
  <form action="../traitements/mdpOublier.php" method="post">
    <div class="input-group mt-5 d-flex justify-content-center spe">
      <input type="email" name="email" required>
      <label>Votre email :</label>
      <span class="highlight mt-3"></span>
    </div>

    <div class="form-group text-center btn-group d-flex justify-content-center mt-5">
      <button type="submit" class="btn btn-primary radius">
        Chercher
      </button>
    </div>
  </form>
  <?php
}

elseif(!empty($_GET["status"]) && $_GET["status"] == "none"){
  ?>
  <form action="../traitements/mdpOublier.php" method="post">
    <div class="input-group mt-5 d-flex justify-content-center spe">
      <input type="email" name="email" class="inputError" id="inputError" required>
      <label class = "labelError" id="labelError"><i>Aucun compte n'est associé à cet email</i></label>
      <span class="highlightErr mt-3"></span>
    </div>

    <div class="form-group text-center btn-group d-flex justify-content-center mt-5">
      <button type="submit" class="btn btn-primary radius">
        Chercher
      </button>
    </div>
  </form>
  <?php
}

elseif(!empty($_GET["status"]) && $_GET["status"] == "exist" && empty($_GET["reponse"])){
  ?>
  <form action="../traitements/mdpOublier.php" method="post">
    <div class="input-group mt-5 d-flex justify-content-center spe">
      <input type="text" name="reponse" class="input" required>
      <label><?=$test?></label>
      <span class="highlight mt-3"></span>
    </div>
    <div class="form-group text-center btn-group d-flex justify-content-center mt-5">
      <button type="submit" class="btn btn-primary radius">
        Répondre
      </button>
    </div>
  </form>
  <?php
}

elseif(!empty($_GET["status"]) && $_GET["status"] == "exist" && !empty($_GET["reponse"]) && $_GET["reponse"] == "correct"){
  ?>
  <form action="../traitements/mdpOublier.php?modif" method="post">
    <div class="input-group mt-5 d-flex justify-content-center spe">
      <input type="password" name="newMdp" class="input" required>
      <label>Nouveau mot de passe</label>
      <span class="highlight mt-3"></span>
    </div>
    <div class="form-group text-center btn-group d-flex justify-content-center mt-5">
      <button type="submit" class="btn btn-primary radius">
        Changer le mot de passe
      </button>
    </div>
  </form>
  <?php
}

elseif(!empty($_GET["status"]) && $_GET["status"] == "exist" && !empty($_GET["reponse"]) && $_GET["reponse"] == "false"){
  ?>
  <form action="../traitements/mdpOublier.php" method="post">
    <div class="input-group mt-5 d-flex justify-content-center spe">
      <input type="text" name="reponse" class="inputError" required>
      <label class = "labelError"><?=$test?></label>
      <span class="highlightErr mt-3"></span>
    </div>
    <div class="form-group text-center btn-group d-flex justify-content-center mt-5">
      <button type="submit" class="btn btn-primary radius">
        Répondre
      </button>
    </div>
  </form>
  <?php
}

elseif(!empty($_GET["status"]) && $_GET["status"] == "end"){
  ?>
    <div class="alert alert-success mt-3">
      <p>Votre mot-de-passe à bien été changer !</p>
    </div>
    <div class="form-group text-center btn-group d-flex justify-content-center mt-5">
      <a href="../vues/connexion.php" class="btn btn-primary text-light radius">
        Revenir à la connexion
      </a>
    </div>
  <?php
}
?>
<script src="../js/script.js"></script>