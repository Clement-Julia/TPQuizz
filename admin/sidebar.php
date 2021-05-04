<?php
require_once "header.php";
require_once "../traitements/traitement.php";
?>


<nav class="sidebarnav select" style="z-index: 999">
  <div class="sidebarpos"></div>
    <ul>
      <li class="mb-3 mt-5"><a href="../vues/"><i class="fa fa-user fa-lg"></i><span class="nav-text">Home user</span></a></li>   
      <li class="mb-3"><a href="../admin/"><i class="fa fa-user-cog fa-lg"></i><span class="nav-text">Home admin</span></a></li>   
      <li class="mb-3"><a href="../vues/listeQuizz.php"><i class="fa fa-newspaper fa-lg"></i><span class="nav-text">Liste des quizz</span></a></li>
      <li class="mb-3"><a href="../vues/ajouterQuizz.php"><i class="fa fa-plus fa-lg"></i><span class="nav-text">Ajouter un quizz</span></a></li>
      <li class="mb-3"><a href="../admin/modifierQuizz.php"><i class="fa fa-tasks fa-th-list"></i><span class="nav-text">Gérer les quizz</span></a></li>
      <li class="mb-3"><a href="../admin/ajoutCat.php"><i class="fa fa-plus fa-lg"></i><span class="nav-text">Ajouter une catégorie</span></a></li>
      <li class="mb-3"><a href="../admin/modifierCat.php"><i class="fa fa-tasks fa-list"></i><span class="nav-text">Gérer les catégories</span></a></li>
      <li class="mb-3"><a href="#"><i class="fa fa-tasks fa-lg"></i><span class="nav-text">Gérer les utilisateurs</span></a></li>
      <li class="mb-3"><a href="../traitements/deconnexion.php"><i class="fa fa-sign-out-alt"></i><span class="nav-text">Se déconnecter</span></a></li>
    </ul>
  </div>
</nav>