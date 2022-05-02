<?php
    /* --------------------------------- IMPORTS --------------------------------- */
    include './utils/connectBdd.php';
    include './model/model_util.php';
    include './view/view_connect.php';

    
    /* --------------------------------- LOGIQUE --------------------------------- */
    // on verifie si les champs sont remplis
    if(isset($_POST['mail_util']) && ($_POST['mail_util'] != "") && 
    isset($_POST['mdp_util']) && ($_POST['mdp_util'] != "")){
        $mail = $_POST['mail_util'];
        $mdp = $_POST['mdp_util'];
        // on creer une nouvelle instance d'Utilisateur
        $util = new Utilisateur();
        // on recupere le compte pour avoir toutes les infos du compte (id en plus dans $newUtil)
        $util->setMail($mail);
        // on recupére le compte en fonction du login saisie
        $account = $util->getUserByMail($bdd);
        // on verifie si le retour de $account n'est pas égale à null
        if($account != null){
            // le compte existe en BDD, on peut passer à la verification du mdp
            // on verifie si le mdp saisie correspond au mdp retourner par la BDD
            if(password_verify($mdp, $account->mdp_util)){
                // on set les valeurs de $account dans $util
                $util->setId($account->id_util);
                $util->setNom($account->nom_util);
                $util->setPrenom($account->prenom_util);
                $util->setMdp($account->mdp_util);
                // on initialise les varibles de session avec les attributs de $util
                $_SESSION['id_util'] = $util->getId();
                $_SESSION['nom_util'] = $util->getNom();
                $_SESSION['prenom_util'] = $util->getPrenom();
                $_SESSION['mail_util'] = $util->getMail();
                $_SESSION['mdp_util'] = $util->getMdp();
                $_SESSION['connected'] = true;
                // on affiche le message
                echo "<p>Connecté</p>";
                // on redirige vers la page liste des articles après 3s
                echo '
                <script>
                    setTimeout(()=>{
                        document.location.href="/evalmvc/showAllArticle";
                    },3000);
                </script>';
            }
            else{
                // sinon on affiche le message
                echo "<p>Informations incorrectes</p>";
            }
        }
        else{
            // sinon on affiche le message 
            echo "<p>Informations incorrectes</p>";
        }  
    }
    // import du footer
    include './view/view_footer.php';
?>

