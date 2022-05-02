<?php
    /* --------------------------------- IMPORTS --------------------------------- */
    include './utils/connectBdd.php';
    include './model/model_util.php';
    include './view/view_header.php';
    include './view/view_add_user.php';


    /* --------------------------------- LOGIQUE --------------------------------- */
    if(isset($_POST['nom_util']) && ($_POST['nom_util'] != "") && 
    isset($_POST['prenom_util']) && ($_POST['prenom_util'] != "") &&
    isset($_POST['mail_util']) && ($_POST['mail_util'] != "") &&
    isset($_POST['mdp_util']) && ($_POST['mdp_util'] != "")){
        $nom = $_POST['nom_util'];
        $prenom = $_POST['prenom_util'];
        $mail = $_POST['mail_util'];
        $mdp = $_POST['mdp_util'];
        // creation d'une nouvelle instance d'Utilisateur
        $newUtil = new Utilisateur();
        // on set le mail saisie à l'instance d'Utilisateur $newUtil
        $newUtil->setMail($mail);
        // on recherche l'utilisateur en fonction du mail saisie
        $compte = $newUtil->getUserByMail($bdd);
        // on verifie si le retour de la BDD est null
        if($compte == null){
            // on n'a rien trouvé en BDD, le mail n'existe pas encore on peut créer le compte
            // on set les autres autres attributs de $newUtil
            $newUtil->setNom($nom);
            $newUtil->setPrenom($prenom);
            // on hash le mdp avant de le set à l'objet 
            $hash = password_hash($mdp, PASSWORD_BCRYPT, array("cost" => 10));
            $newUtil->setMdp($hash);
            // on ajoute le compte en BDD 
            $newUtil->addUser($bdd);
            // on affiche le message de réussite
            echo "<p>Création de compte réussi</p>";
            // on redirige vesr la page de connexion après 3s
            echo '
            <script>
                setTimeout(()=>{
                    document.location.href="/evalmvc/"; 
                },3000);
            </script>';
        }
        else{
            // sinon le mail existe déjà en BDD, on affiche le message 
            echo "<p>Création de compte impossible</p>";
        }
    }
    else{
        echo "<p>Veuillez remplir les champs du fomrmulaire</p>";
    }
    // Import du footer
    include './view/view_footer.php';
?>

