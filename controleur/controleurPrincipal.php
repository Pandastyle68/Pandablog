<?php
session_start();
include_once "$racine/modele/bd.posts.inc.php";

function controleurPrincipal($page){
    $lesActions = array();
    $lesActions["posts"] = "posts.php";
    $lesActions["post"] = "post.php";
    $lesActions["liste"] = "listeRestos.php";
    $lesActions["signin"] = "connexion.php";
    $lesActions["signup"] = "signup.php";
    $lesActions["disconnect"] = "deconnexion.php";
    $lesActions["newpost"] = "newpost.php";
    $lesActions["newtags"] = "newtags.php";
    $lesActions["tags"] = "tags.php";
    
    if (array_key_exists ( $page , $lesActions )){
        return $lesActions[$page];
    }
    else{
        return $lesActions["posts"];
    }

}

?>