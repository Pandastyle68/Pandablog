<?php
include "getRacine.php";
include "$racine/controleur/controleurPrincipal.php";
include_once "$racine/modele/authentification.inc.php";



if (isset($_GET["page"])){
    $page = $_GET["page"];
}
else{
    
    $page = "posts";
}

$fichier = controleurPrincipal($page);
include "$racine/controleur/$fichier";


?>
     