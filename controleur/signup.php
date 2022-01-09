<?php

include_once "$racine/modele/bd.utilisateur.inc.php";

if(isset($_POST['usrname']) & isset($_POST['pswd']) & isset($_POST['mail']) ){
    addUser($_POST['usrname'], $_POST['pswd'], $_POST['mail']);
    include "$racine/controleur/redirect.php";
}else{
    $titre = "Inscription";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueInscription.php";
    include "$racine/vue/pied.html.php";
}


?>