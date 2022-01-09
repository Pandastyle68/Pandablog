<?php

include_once "bd.utilisateur.inc.php";

function login($mailU, $mdpU) {


    $util = getUserByMail($mailU);
    $util["password"] ??= '';
    $mdpBD = $util["password"];

    if (md5($mdpU) === $mdpBD) {
        // le mot de passe est celui de l'utilisateur dans la base de donnees
        $_SESSION["mailU"] = $mailU;
        $_SESSION["mdpU"] = $mdpBD;
        $_SESSION["access"] = $util["level"];
    }else{
        echo($mdpU);
        echo($mdpBD);
    }
}

function logout() {
    if (!isset($_SESSION)) {
        session_start();
    }
    unset($_SESSION["mailU"]);
    unset($_SESSION["mdpU"]);
}

function getMailULoggedOn(){
    if (isLoggedOn()){
        $ret = $_SESSION["mailU"];
    }
    else {
        $ret = "";
    }
    return $ret;
        
}

function isLoggedOn() {
    if (!isset($_SESSION)) {
        session_start();
    }
    $ret = false;

    if (isset($_SESSION["mailU"])) {
        $util = getUserByMail($_SESSION["mailU"]);
        if ($util["mail"] == $_SESSION["mailU"] && $util["password"] == $_SESSION["mdpU"]
        ) {
            $ret = true;
        }
    }
    return $ret;
}

?>