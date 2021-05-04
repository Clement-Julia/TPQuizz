<?php

if(empty($_SESSION["idRole"]) || $_SESSION["idRole"] == 1){
    header("location:vues/index.php");
}else {
    header("location:admin/index.php");
}