<?php
$titre = "Pandabooru";
include_once "$racine/modele/bd.posts.inc.php";



if (isset($_GET['id'])) {
    $lePost = getPostById($_GET['id']);
    $pAuthor = getPostAuthor($lePost['idUser']);
    $lesTags = getTags();
    $postTags = getPostTags($_GET['id']);
    $titre = $lePost['label'];
    if (isset($_POST['selectedTags'])) {
        $tagsArray = $_POST['selectedTags'];
        foreach ($tagsArray as $unTag) {
            $idT = getTagByLabel($unTag);
            addPostTags($idT['id'], $_GET['id']);
            include "$racine/controleur/redirect.php";
        }
    }
    if (isset($_POST['remTags'])) {
        delPostTag($_GET['id'], $_POST['remTags']);
        include "$racine/controleur/redirect.php";
    }
}

include "$racine/vue/entete.html.php";
include "$racine/vue/vueTagMod.php";
include "$racine/vue/pied.html.php";
include_once "$racine/controleur/updateNsfw.php";