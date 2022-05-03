<?php 
    class Utilisateur{
        /* ------------------------------ ATTRIBUTS ------------------------------ */
        protected $id;
        protected $nom;
        protected $prenom;
        protected $mail;
        protected $mdp;
        

        /* ------------------------------ CONSTRUCTEUR ------------------------------*/
        public function __construct()
        {

        }


        /* ------------------------------ GETTERS  & SETTERS ------------------------------ */
        /**
         * Get the value of id
         */ 
        public function getId():int
        {
            return $this->id;
        }

        /**
         * Set the value of id
         */ 
        public function setId($id):void
        {
            $this->id = $id;
        }

        /**
         * Get the value of nom
         */ 
        public function getNom():string
        {
            return $this->nom;
        }

        /**
         * Set the value of nom
         */ 
        public function setNom($nom):void
        {
            $this->nom = $nom;
        }

        /**
         * Get the value of prenom
         */ 
        public function getPrenom():string
        {
            return $this->prenom;
        }

        /**
         * Set the value of prenom
         */ 
        public function setPrenom($prenom):void
        {
            $this->prenom = $prenom;
        }

        /**
         * Get the value of mail
         */ 
        public function getMail():string
        {
            return $this->mail;
        }

        /**
         * Set the value of mail
         */ 
        public function setMail($mail):void
        {
            $this->mail = $mail;
        }

        /**
         * Get the value of mdp
         */ 
        public function getMdp():string
        {
            return $this->mdp;
        }

        /**
         * Set the value of mdp
         */ 
        public function setMdp($mdp):void
        {
            $this->mdp = $mdp;
        }


        /* ------------------------------ METHODES ------------------------------ */
        // Fonction qui ajoute un utilisateur en BDD
        public function addUser($bdd):void
        {
            try{
                $req = $bdd->prepare('INSERT INTO utilisateur(nom_util, prenom_util, mail_util, mdp_util)
                VALUES(:nom_util, :prenom_util, :mail_util, :mdp_util);');
                $req->execute(array(
                    "nom_util" => $this->getNom(),
                    "prenom_util" => $this->getPrenom(),
                    "mail_util" => $this->getMail(),
                    "mdp_util" => $this->getMdp()
                ));
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }
        }

        // Fonction qui renvoie un utilisateur en fonction de son mail
        public function getUserByMail($bdd){
            try{
                $req = $bdd->prepare('SELECT * FROM utilisateur
                WHERE mail_util = :mail_util;');
                $req->execute(array(
                    "mail_util" => $this->getMail()
                ));
                return $req->fetch(PDO::FETCH_OBJ);
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }
        }
        
    }
?>

