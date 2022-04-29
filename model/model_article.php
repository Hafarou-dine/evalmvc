<?php
    class Article{
        /*-----------------------------------------
                        ATTRIBUTS
        ----------------------------------------*/
        private $id_article;
        private $nom_article;
        private $prix_article;


        /*-----------------------------------------
                        CONSTRUCTEUR
        ----------------------------------------*/
        public function __construct($nom, $prix){
            $this->nom_article = $nom;
            $this->prix_article = $prix;
        }


        /*-----------------------------------------
                    GETTERS AND SETTER
        ----------------------------------------*/
        public function getIdArticle():int{
            return $this->id_article;
        }

        public function getNomArticle():string{
            return $this->nom_article;
        }

        public function getPrixArticle():float{
            return $this->prix_article;
        }

        public function setIdArticle($id):void{
            $this->id_article = $id;
        }

        public function setNomArticle($nom):void{
            $this->nom_article = $nom;
        }

        public function setPrixArticle($prix):void{
            $this->prix_article = $prix;
        }


        /*-----------------------------------------
                        METHODES
        ----------------------------------------*/
        //version depuis l'instance de l'objet
        public function addArticle($bdd):void{
            $nom = $this->getNomArticle();
            $prix = $this->getPrixArticle();
            try{
                $req = $bdd->prepare('INSERT INTO article(nom_article, prix_article) 
                VALUES(:nom_article, :prix_article);');
                $req->execute(array(
                    'nom_article' => $nom,
                    'prix_article' =>$prix
                    ));
            }
            catch(Exception $e)
            {
                //affichage d'une exception en cas d’erreur
                die('Erreur : '.$e->getMessage());
            }
        }

        // Fonction qui renvoi un article en fonction de son id
        public function showArticleById($bdd, $id):object{
            try{
                $req = $bdd->prepare('SELECT * FROM article
                WHERE id_article = :id_article;');
                $req->execute(array(
                    'id_article' => $id
                ));
                return $req->fetch(PDO::FETCH_OBJ);
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }

        }

        // Fonction qui renvoie la liste de tous les articles en BDD
        public function showAllArticle($bdd):array{
            try{
                $req = $bdd->prepare('SELECT * FROM article;');
                $req->execute();
                return $req->fetchAll(PDO::FETCH_OBJ);
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }
        }

        // Fonction qui met à jour un article
        public function updateArticle($bdd){
            
            try{
                $req = $bdd->prepare('UPDATE article
                SET nom_article = :nom_article, prix_article = :prix_article
                WHERE id_article = :id_article;');   
                $req->execute(array(
                    'nom_article' => $this->getNomArticle(),
                    'prix_article' => $this->getPrixArticle(),
                    'id_article' => $this->getIdArticle()
                )); 
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }
        }

        // Fonction qui supprime un article
        public function deleteArticle($bdd){
            try{
                $req = $bdd->prepare('DELETE FROM article
                WHERE id_article = :id_article;');
                $req->execute(array(
                    'id_article' => $this->getIdArticle()
                ));   
            }
            catch(Exception $e){
                die('Erreur : '.$e->getMessage());
            }
        }

    }
?>