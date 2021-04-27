<?php

class Destroy {
    
    public function sessDestroy() {
        if(empty($_SESSION["idUtilisateur"])){
            session_destroy();
        }
    }
}