<?php
    /* --------------------------------- IMPORTS --------------------------------- */
    include './utils/connectBdd.php';
    include './model/model_article.php';
    include './view/view_header.php';
    include './view/view_add_article.php';


    /* --------------------------------- LOGIQUE --------------------------------- */
    // on verifie si un utilisateur est connecter
    if(isset($_SESSION['connected'])){
        // on verifie si les champs sont remplis
        if(isset($_POST['nom_article']) AND isset($_POST['prix_article']) AND 
        $_POST['nom_article'] != "" AND $_POST['prix_article'] !=""){
            //instancier un nouvel objet Article (appel au constructeur)
            $article = new Article($_POST['nom_article'], $_POST['prix_article']);
            //appel à la méthode addArticleV2 de la classe Article
            $article->addArticle($bdd);
            //utiliser le getter pour afficher le nom
            echo '<p>L\'article '.$article->getNomArticle().' à été ajouté</p>';
        }
        else{
            // sinon on affiche le message
            echo '<p>Veuillez remplir les champs du formulaire</p>';
        }
    }
    // sinon
    else{
        // on redirige vers la page de connexion apres 0ms
        echo '
        <script>
            setTimeout(()=>{
                document.location.href="/evalmvc";
            },0);
        </script>';
    }
    // Import du footer
    include './view/view_footer.php';
?>

