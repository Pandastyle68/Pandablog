<?php
if (str_replace('/','\\',$_SERVER["SCRIPT_FILENAME"]) == __FILE__) {

    $racine="..";
}
include_once "$racine/modele/authentification.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";





// recuperation des donnees GET, POST, et SESSION

// appel des fonctions permettant de recuperer les donnees utiles a l'affichage 
if (isLoggedOn()){
    $mailU = getMailULoggedOn();
    $util = getUserByMail($mailU);
    
    
    // appel du script de vue qui permet de gerer l'affichage des donnees
    $titre = "Mon profil";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/vueMonProfil.php";
    include "$racine/vue/pied.html.php";
}
else{
    $titre = "Mon profil";
    include "$racine/vue/entete.html.php";
    include "$racine/vue/pied.html.php";
}

?>