<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body class="d-flex flex-column min-vh-100">
    <header class="mb-2">
        <nav class="navbar navbar-expand-lg navbar-light bg-info">
            <div class="container-fluid">
                <?php
                    $url = parse_url($_SERVER['REQUEST_URI']);
                    if(isset($_SESSION['connected'])){  
                        echo '<a class="navbar-brand fs-4" href="/evalmvc/showAllArticle">Site</a>';
                    }
                    else{
                        echo '<a class="navbar-brand fs-4" href="/evalmvc">Site</a>';
                    }
                ?>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                        <?php
                            if(isset($_SESSION['connected'])){
                                echo '
                                <a class="btn btn-primary me-3 px-3 py-2" href="/evalmvc/addArticle" role="button">Ajouter Article</a>
                                <a class="btn btn-primary me-3 px-3 py-2" href="/evalmvc/showAllArticle" role="button">Afficher Articles</a>
                                <a class="btn btn-primary me-5 px-3 py-2" href="/evalmvc/updateArticle" role="button">Modifier Article</a>
                                <a class="btn btn-primary me-3 px-3 py-2" href="/evalmvc/deco" role="button">Deconnexion</a>';
                            }
                            else{
                                if($url['path'] === "/evalmvc/addUser"){
                                    echo '
                                    <a class="btn btn-primary me-3 px-3 py-2" href="/evalmvc/" role="button">Connexion</a>';
                                }
                                if($url['path'] === "/evalmvc/"){
                                    echo '
                                    <a class="btn btn-primary me-3 px-3 py-2" href="/evalmvc/addUser" role="button">Creer Compte</a>';
                                }
                            } 
                        ?>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>

