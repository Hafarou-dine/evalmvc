<?php
    // ouverture de session 
    session_start();

    /* --------------------------------- IMPORTS --------------------------------- */
    include './utils/connectBdd.php';
    include './model/model_article.php';
    include './view/view_header.php';
    include './view/view_show_all_article.php';

    
    /* --------------------------------- LOGIQUE --------------------------------- */
    $all = new Article(null, null); 
    $data = $all->showAllArticle($bdd);
    foreach($data as $value){
        echo '<p><input type="checkbox" name="id[]" value="'.$value->id_article.'"><a href="/evalmvc/updateArticle?id='.$value->id_article.'">L\'article '.$value->nom_article.' a un prix égale à '.$value->prix_article.'€</a></p>';
    }
    echo '<p><input type="submit" value="Supprimer"></p>
    </form>';
    if(isset($_GET['error'])){
        echo "<p>Veuillez cliquer sur un article à modifier</p>";
    }
    if(isset($_POST['id'])){
        foreach($_POST['id'] as $idarticle){
            $article = new Article(null, null);
            $data = $article->showArticleById($bdd, $idarticle);
            $article->setIdArticle($data->id_article);
            $article->setNomArticle($data->nom_article);
            $article->setPrixArticle($data->prix_article);
            $article->deleteArticle($bdd);
            echo '<p>Suppresion de l\'article '.$article->getNomArticle().'</p>';
            echo '
            <script>
                setTimeout(()=>{
                    document.location.href="/evalmvc/showAllArticle"; 
                },1000);
            </script>';
        }
    }
    else{
        echo "<p>Veuillez selectionner un ou plusieurs articles a supprimer</p>";
    }
    include './view/view_footer.php';
?>    

