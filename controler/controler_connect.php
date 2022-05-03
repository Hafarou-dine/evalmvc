<?php
    /* --------------------------------- IMPORTS --------------------------------- */
    include './utils/connectBdd.php';
    include './model/model_util.php';
    include './model/model_admin.php';
    include './view/view_header.php';
    include './view/view_connect.php';

    
    /* --------------------------------- LOGIQUE --------------------------------- */
    // on verifie si les champs sont remplis
    if(isset($_POST['mail_util']) && ($_POST['mail_util'] != "") && 
    isset($_POST['mdp_util']) && ($_POST['mdp_util'] != "")){
        $mail = $_POST['mail_util'];
        $mdp = $_POST['mdp_util'];
        // on verifie si la case admin est coché
        // on se conncete en tant qu'administrateur
        if(isset($_POST['admin'])){ 
            // on creer une nouvelle instance d'Admin
            $util = new Admin();
            // on recupere le compte pour avoir toutes les infos du compte (id en plus dans $newUtil)
            $util->setMail($mail);
            // on recupére le compte en fonction du login saisie
            $account = $util->getUserByMail($bdd);
            // on verifie si le retour de $account n'est pas égale à null
            if($account != null){
                // le compte existe en BDD, on peut passer à la verification du mdp
                // on verifie si le mdp saisie correspond au mdp retourner par la BDD
                if(password_verify($mdp, $account->mdp_admin)){
                    // on set les valeurs de $account dans $util
                    $util->setId($account->id_admin);
                    $util->setNom($account->nom_admin);
                    $util->setPrenom($account->prenom_admin);
                    $util->setMdp($account->mdp_admin);
                    // on initialise les varibles de session avec les attributs de $util
                    $_SESSION['id_admin'] = $util->getId();
                    $_SESSION['nom_admin'] = $util->getNom();
                    $_SESSION['prenom_admin'] = $util->getPrenom();
                    $_SESSION['mail_admin'] = $util->getMail();
                    $_SESSION['mdp_admin'] = $util->getMdp();
                    $_SESSION['connected'] = true;
                    // on redirige vers la page liste des articles après 0ms
                    echo '
                    <script>
                        setTimeout(()=>{
                            document.location.href="/evalmvc/showAllUser";
                        },0);
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
        else{
            // sinon on se connecte en tanq que simple utilistateur  
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
                    // on redirige vers la page liste des articles après 0ms
                    echo '
                    <script>
                        setTimeout(()=>{
                            document.location.href="/evalmvc/showAllArticle";
                        },0);
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
          
    }
    // Import du footer
    include './view/view_footer.php';
?>

