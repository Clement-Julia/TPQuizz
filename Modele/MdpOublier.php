<?php
class Mdp extends Modele {
     
    public function getMdp($email){
        $req = parent::getBdd()->prepare("SELECT email FROM utilisateurs WHERE email = ?");
        $req->execute([$email]);
        $email = $req->FetchAll(PDO::FETCH_ASSOC);
        return $email;
    }

    public function getQuestion($email){
        $req = parent::getBdd()->prepare("SELECT question FROM question_secrete INNER JOIN utilisateurs USING(idQuestionS) where email = ?");
        $req->execute([$email]);
        $question = $req->FetchAll(PDO::FETCH_ASSOC);
        return $question;
    }

    public function getReponseSecrete($email){
        $req = parent::getBdd()->prepare("SELECT reponse_secrete FROM utilisateurs where email = ?");
        $req->execute([$email]);
        $reponse = $req->FetchAll(PDO::FETCH_ASSOC);
        return $reponse;
    }
    
    public function modifMdp($newMdp, $email){
        $req = parent::getBdd()->prepare("UPDATE utilisateurs set mdp = ? WHERE email = ?");
        $req->execute([$newMdp, $email]);
    }
}