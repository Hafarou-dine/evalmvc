<?php 
    class Admin extends Utilisateur{

        /* ------------------------------ METHODES ------------------------------ */
        // Fonction qui ajoute un utilisateur en BDD
        public function addUser($bdd):void
        {
            try{
                $req = $bdd->prepare('INSERT INTO administrateur(nom_admin, prenom_admin, mail_admin, mdp_admin)
                VALUES(:nom_admin, :prenom_admin, :mail_admin, :mdp_admin);');
                $req->execute(array(
                    "nom_admin" => $this->getNom(),
                    "prenom_admin" => $this->getPrenom(),
                    "mail_admin" => $this->getMail(),
                    "mdp_admin" => $this->getMdp()
                ));
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }
        }

        // Fonction qui renvoie un utilisateur en fonction de son mail
        public function getUserByMail($bdd)
        {
            try{
                $req = $bdd->prepare('SELECT * FROM administrateur
                WHERE mail_admin = :mail_admin;');
                $req->execute(array(
                    "mail_admin" => $this->getMail()
                ));
                return $req->fetch(PDO::FETCH_OBJ);
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }
        }

        // fonction qui renvoie la liste de tous les utilisateur
        public function showAllUser($bdd):array
        {
            try{
                $req = $bdd->prepare('SELECT * FROM utilisateur;');
                $req->execute();
                return $req->fetchAll(PDO::FETCH_OBJ);
            }
            catch(Exception $e){
                die('Erreur :'.$e->getMessage());
            }
        }
    }
?>

