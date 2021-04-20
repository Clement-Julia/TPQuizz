<?php
$chaine = "";
$repet = "";
$test = explode(" ", $chaine);

for($x = 0; $x < count($test); $x++){
    $repet .= "titre LIKE '%$test[$x]%' OR ";
}
// $wow = implode(" ", $repet);

print_r($repet);