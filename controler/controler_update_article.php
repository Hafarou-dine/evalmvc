<?php
    /* --------------------------------- IMPORTS --------------------------------- */
    include './utils/connectBdd.php';
    include './model/model_article.php';
    include './view/view_header.php';
    include './view/view_update_article.php';

    
    /* --------------------------------- LOGIQUE --------------------------------- */
    if(isset($_GET['id']) && ($_GET['id'] != "")){
        $id = $_GET['id'];
        $article = new Article(null, null);
        $data = $article->showArticleById($bdd, $id);
        // var_dump($data);
        $article->setIdArticle($data->id_article);
        $article->setNomArticle($data->nom_article);
        $article->setPrixArticle($data->prix_article);
        echo '<script>
            remplir("'.$article->getNomArticle().'", "'.$article->getPrixArticle().'");
        </script>';
        if(isset($_POST['nom_article']) && ($_POST['nom_article'] != "") &&
        isset($_POST['prix_article']) && ($_POST['prix_article'] != "")){
            $article->setNomArticle($_POST['nom_article']);
            $article->setPrixArticle($_POST['prix_article']);
            $article->updateArticle($bdd);
            echo '<p>L\'article numero '.$article->getIdArticle().' a été modifier</p>';
            echo '
            <script>
                setTimeout(()=>{
                    document.location.href="/evalmvc/updateArticle?id='.$data->id_article.'"; 
                },1000);
            </script>';
        }
        else{
            echo "<p>Veuillez saisir vos modifications</p>";
        }
    }
    else{
        echo '
        <script>
            setTimeout(()=>{
                document.location.href="/evalmvc/showAllArticle?error"; 
            },0);
        </script>';
    }
    include './view/view_footer.php';
?>