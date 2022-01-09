<?php
if(!isset($_SESSION)){
    session_start();
}
if (str_replace('/','\\',$_SERVER["SCRIPT_FILENAME"]) == __FILE__) {

    $racine="..";
}

include_once "$racine/modele/bd.posts.inc.php";
include_once "$racine/modele/bd.coms.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";

if(isset($_GET['id'])){
    $lePost = getPostById($_GET['id']);
    $pAuthor = getPostAuthor($lePost['idUser']);
    $lesComs = getComsByPostId($_GET['id']);
    $lesTags = getPostTags($_GET['id']);
    $titre = $lePost['label'];
    include "$racine/vue/entete.html.php";
    if(isset($_SESSION['mailU'])){
        if(isset($_POST['submit'])){
            if($_POST['submit'] == "Supprimer Post"){
                delPosts($_GET['id']);
                include("$racine/controleur/redirect.php");
            }else{
                remComs($_POST['submit']);
                include("$racine/controleur/redirect.php");
            }
            
            
        }
        $user = getUserByMail($_SESSION['mailU']);
        if(isset($_POST['comcontent'])){
            addCom($_POST['comcontent'], $user['id'], $_GET['id'] );
            include("$racine/controleur/redirect.php");
        }
    }
    include "$racine/vue/vuePostDetails.php";
    include "$racine/vue/pied.html.php";
}else{
    include("$racine/controleur/redirect.php");
}
?>