<?php
if (!isset($_SESSION)) {
    session_start();
}
if (str_replace('/', '\\', $_SERVER["SCRIPT_FILENAME"]) == __FILE__) {

    $racine = "..";
}
$tes = 0;
include_once "$racine/modele/bd.posts.inc.php";
if ((isset($_GET['num'])) & !empty($_GET['num'])) {
    $currentPage = (int) strip_tags($_GET['num']);
} else {
    $currentPage = 1;
}
// On détermine le nombre d'articles par page
$parPage = 8;

if (isset($_GET["tags"])) {
    if ($_GET["tags"] == "") {
        $nbPosts = getNbPosts();
        $premier = (($currentPage * $parPage) - $parPage);
        // On calcule le nombre de pages total
        $pages = ceil($nbPosts / $parPage);
        $listePosts = getPosts($premier, $parPage);
    } else {
        if ((count(explode(",", $_GET['tags'])) > 1)) {
            $nbPosts = getNbPostsWTags($_GET["tags"]);
            $nbPosts = count($nbPosts);
            $premier = (($currentPage * $parPage) - $parPage);
            $tes = $nbPosts;
            // On calcule le nombre de pages total
            $pages = ceil($nbPosts / $parPage);
            $listePosts = getPostsByTags($_GET["tags"], $premier, $parPage);
        } else {
            $nbPosts = getNbPostsWTags($_GET["tags"]);
            $premier = (($currentPage * $parPage) - $parPage);
            $tes = $nbPosts;
            // On calcule le nombre de pages total
            $pages = ceil($nbPosts / $parPage);
            $listePosts = getPostsByTags($_GET["tags"], $premier, $parPage);
        }
    }
} else {
    $nbPosts = getNbPosts();
    $premier = (($currentPage * $parPage) - $parPage);
    // On calcule le nombre de pages total
    $pages = ceil($nbPosts / $parPage);
    $listePosts = getPosts($premier, $parPage);
}

    // appel des fonctions permettant de recuperer les donnees utiles a l'affichage 


    // traitement si necessaire des donnees recuperees
;

// appel du script de vue qui permet de gerer l'affichage des donnees
if(isset($_GET['tags'])){
    $titre = $_GET['tags'];
}else{
    $titre = "Pandabooru";
}
if(isset($_GET['num'])){
    $nbPage = $_GET['num'];
    $titre = "$titre | Page : $nbPage";
}
include "$racine/vue/entete.html.php";
include "$racine/vue/vueVideo.php";
include "$racine/vue/vueListePosts.php";
include "$racine/vue/pied.html.php";
