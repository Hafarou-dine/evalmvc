<?php
    /* --------------------------------- IMPORTS --------------------------------- */
    include './utils/connectBdd.php';
    include './model/model_article.php';
    include './view/view_header.php';
    include './view/view_show_all_article.php';

    
    /* --------------------------------- LOGIQUE --------------------------------- */
    // on verifie si un utilisateur est connecter
    if(isset($_SESSION['connected'])){
        // on creer une nouvelle instance d'Article
        $all = new Article(null, null);
        // on recupére la liste de tous les articles en BDD 
        $data = $all->showAllArticle($bdd);
        // pour chaque article de la liste 
        foreach($data as $value){
            // on affiche une ligne avec le nom et prix de l'article
            echo '<p><input type="checkbox" name="id[]" value="'.$value->id_article.'"><a href="/evalmvc/updateArticle?id='.$value->id_article.'">L\'article '.$value->nom_article.' a un prix égale à '.$value->prix_article.'€</a></p>';
        }
        echo '<p><input type="submit" value="Supprimer"></p>
        </form>';
        // on verifie si error est defini
        if(isset($_GET['error'])){
            // on affiche le message 
            echo "<p>Veuillez cliquer sur un article à modifier</p>";
        }
        // on verifie si le tableau d'id[] n'est pas vide
        if(isset($_POST['id'])){
            // pour chaque id du tableau id[]
            foreach($_POST['id'] as $idarticle){
                // on creer une nouvelle instance d'Article
                $article = new Article(null, null);
                // on recupere l'article selectionner par son id
                $data = $article->showArticleById($bdd, $idarticle);
                // on set les valeur de $article avec les valeur de l'objet retourne par la BDD
                $article->setIdArticle($data->id_article);
                $article->setNomArticle($data->nom_article);
                $article->setPrixArticle($data->prix_article);
                $article->deleteArticle($bdd);
                // on affiche le message 
                echo '<p>Suppresion de l\'article '.$article->getNomArticle().'</p>';
                // on redirige vesr la page showAllArticle apres 1s
                echo '
                <script>
                    setTimeout(()=>{
                        document.location.href="/evalmvc/showAllArticle"; 
                    },1000);
                </script>';
            }
        }
        else{
            // sinon on affiche le message
            echo "<p>Veuillez selectionner un ou plusieurs articles a supprimer</p>";
        }
    }
    // sinon 
    else{
        // on rediriige vers la page de connexion après 0ms
        echo '
        <script>
            setTimeout(()=>{
                document.location.href="/evalmvc/"; 
            },0);
        </script>';
    }
    // Import du footer
    include './view/view_footer.php';
?>    

