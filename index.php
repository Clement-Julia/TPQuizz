<?php

if(empty($_SESSION["idRole"]) || $_SESSION["idRole"] == 1){
    header("location:vues/utilisateurs/index.php");
} else {
    header("location:vues/admin/index.php");
}