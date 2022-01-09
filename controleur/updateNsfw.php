<?php
if (str_replace('/','\\',$_SERVER["SCRIPT_FILENAME"]) == __FILE__) {

    $racine="..";
}
include_once "$racine/modele/bd.posts.inc.php";
$poststoUpdate = getPosts(0, getNbPosts());
foreach($poststoUpdate as $posttoupdate){
    if(getPostNsfw($posttoupdate['id'])){
        updateNsfwPost($posttoupdate['id'], 1);
    }else{
        updateNsfwPost($posttoupdate['id'], 0);
    }
}
?>