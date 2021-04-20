<?php
class Connexion extends Modele{
    
    function verifConnexion($identifiant){
        $requete = parent::getBdd()->prepare("SELECT idUtilisateur, pseudo, mdp, email, idRole FROM utilisateurs WHERE pseudo = ?");
        $requete->execute([$identifiant]);
        $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);
        return $utilisateur;
    }

}