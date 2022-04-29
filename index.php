<?php
    //Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    //test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';

    /*------------------------------------------- ROUTER -------------------------------------------*/
    //test de la valeur $path dans l'URL et import de la ressource
    switch($path){
        // route /evalmvc/addArticle -> ./controler/controler_article.php
        case $path === "/evalmvc/addArticle":
            include './controler/controler_add_article.php';
            break;
        // route /evalmvc/showAllArticle -> ./controler/controler_show_all_article.php
        case $path === "/evalmvc/showAllArticle":
            include './controler/controler_show_all_article.php';
            break;
        // route /evalmvc/updateArticle -> ./controler/controler_update_article.php
        case $path === "/evalmvc/updateArticle":
            include './controler/controler_update_article.php';
            break;
        // route /evalmvc/addUser -> ./controler/controler_add_user.php
        case $path === "/evalmvc/addUser":
            include './controler/controler_add_user.php';
            break;
        // route /evalmvc/addUser -> ./controler/controler_add_user.php
        case $path === "/evalmvc/updateArticle":
            include './controler/controler_update_article.php';
            break;
        // route /evalmvc/deco -> ./controler/controler_deco.php
        case $path === "/evalmvc/deco":
            include './controler/controler_deco.php';
            break;
        // route /evalmvc/ -> ./controler/controler_connect.php (page de connexion)
        case $path === "/evalmvc/":
            include './controler/controler_connect.php';
            break;
        // route différentes de toutes celles definies plus haut -> ./erreur.php
        case $path !== "/evalmvc/":
            include './erreur.php';
            break;
    }
?>

