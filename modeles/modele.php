<?php

class Modele {

    private $dsn = "mysql:host=localhost;dbname=tpquizz;charset=UTF8";
    private $username = "root";
    private $password = "";

    protected function getBdd()
    {
    return new PDO($this->dsn, $this->username, $this->password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    }

}