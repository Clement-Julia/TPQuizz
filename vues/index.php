<?php
require_once "header.php";
require_once "../Modele/modele.php";

if(empty($_SESSION["idUtilisateur"])){
    session_destroy();
}
?>





<?php
require_once "footer.php";
?>