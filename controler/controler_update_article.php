<?php
    /* --------------------------------- IMPORTS --------------------------------- */
    include './utils/connectBdd.php';
    include './model/model_article.php';
    include './view/view_header.php';
    include './view/view_update_article.php';

    
    /* --------------------------------- LOGIQUE --------------------------------- */
    // on verifie si un utilisateur est connecter
    if(isset($_SESSION['connected'])){
        // on verifie si l'id en get est defini et non vide
        if(isset($_GET['id']) && ($_GET['id'] != "")){
            $id = $_GET['id'];
            // on instancie un nouvel Article
            $article = new Article(null, null);
            // on recupere l'article selectionner en fonction de son id 
            $data = $article->showArticleById($bdd, $id);
            // on set les valeur de l'article avec les valeur de l'objet retourne par la BDD
            $article->setIdArticle($data->id_article);
            $article->setNomArticle($data->nom_article);
            $article->setPrixArticle($data->prix_article);
            // on prerempli les champs du formulaire avec notre fonction js 
            echo '<script>
                remplir("'.$article->getNomArticle().'", "'.$article->getPrixArticle().'");
            </script>';
            // on verifie si les champs du formulaire son rempli
            if(isset($_POST['nom_article']) && ($_POST['nom_article'] != "") &&
            isset($_POST['prix_article']) && ($_POST['prix_article'] != "")){
                // on set les valeur de $article avec les valeur dans les champs du formulaire
                $article->setNomArticle($_POST['nom_article']);
                $article->setPrixArticle($_POST['prix_article']);
                // on met à jour l'article
                $article->updateArticle($bdd);
                // on affiche le message 
                echo '<p>L\'article numero '.$article->getIdArticle().' a été modifier</p>';
                // on redirige vers la meme page apres 1s, pour que les modifications soient prises en compte 
                echo '
                <script>
                    setTimeout(()=>{
                        document.location.href="/evalmvc/updateArticle?id='.$data->id_article.'"; 
                    },1000);
                </script>';
            }
            else{
                // sinon on affiche le message
                echo "<p>Veuillez saisir vos modifications</p>";
            }
        }
        // sinon
        else{
            // on redirige vers la page liste des articles apres 0ms
            echo '
            <script>
                setTimeout(()=>{
                    document.location.href="/evalmvc/showAllArticle?error"; 
                },0);
            </script>';
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