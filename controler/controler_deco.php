<?php
// on verifie si un utilisateur est connecter
    if(isset($_SESSION['connected'])){
        // destruction de la session
        session_destroy();
        // on rediriige vers la page de connexion après 0ms
        echo '
        <script>
            setTimeout(()=>{
                document.location.href="/evalmvc/"; 
            },0);
        </script>';
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
?>

