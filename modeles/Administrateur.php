<?php

class Administrateur extends Utilisateur 
{

    private $bannis;

    // on surhcarge la méthode car on a des données supplémentaires à intégrer, inhérentes à la class administrateur
    public function updateUtilisateur($idUtilisateur, $email, $mdp, $pseudo, $reponseS, $idQuestionS, $idRole)
    {
        $this->setMdp($mdp, $idUtilisateur);
        $update = $this->getBdd()->prepare("UPDATE utlisateurs SET email = ?, pseudo = ?, reponse_secrete = ?, idQuestionS = ?, idRole = ? WHERE idUtilisateur = ?");
        $update->execute([$email, $pseudo, $reponseS, $idQuestionS, $idRole, $idUtilisateur]);
    }
    
    public function getBannis()
    {
        return $this->bannis;
    }

    public function setBannis($username)
    {
        $this->bannis[] = $username;
    }

}