<?php
    // destruction de la session
    session_destroy();
    // on rediriige vers la page de connexio après 0s
    echo '
    <script>
        setTimeout(()=>{
            document.location.href="/evalmvc/"; 
        },0);
    </script>';
?>

