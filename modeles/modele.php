<?php

function getBdd(){
    return new PDO('mysql:host=localhost;dbname=tpquizz;charset=UTF8', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
}