<?php
$titre = "Nouveau tag";
include_once "$racine/modele/bd.posts.inc.php";
include_once "$racine/modele/bd.coms.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
if (isset($_POST['tagTxt'])) {
    if (isset($_POST['nsfwBox'])) {
        addTag($_POST['tagTxt'], 1);
    }else{
        addTag($_POST['tagTxt'], 0);
    }
    include "$racine/controleur/redirect.php";
}
include "$racine/vue/entete.html.php";
include "$racine/vue/vueNewTag.php";
include "$racine/vue/pied.html.php";
