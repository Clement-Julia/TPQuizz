<?php

class Modele {

    public function getBdd()
    {
        $dsn = "mysql:host=localhost;dbname=tpquizz;charset=UTF8";
        $username = "root";
        $password = "";
        return new PDO($dsn, $username, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

}