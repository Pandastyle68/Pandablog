<?php

include_once "bd.inc.php";

function addUser($usrname, $pss, $mail) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO users VALUES(id, :usrname, MD5(:pss), :mail, 0)");
        $req->bindValue(':usrname', $usrname, PDO::PARAM_STR);
        $req->bindValue(':pss', $pss, PDO::PARAM_STR);
        $req->bindValue(':mail', $mail, PDO::PARAM_STR);
        $req->execute();


    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}


function getUsers() {
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from users");
        $req->execute();

        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getUserByMail($mailU) {
    $resultat = "";

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from users where mail=:mailU");
        $req->bindValue(':mailU', $mailU, PDO::PARAM_STR);
        $req->execute();
        
        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}


if (str_replace('/','\\',$_SERVER["SCRIPT_FILENAME"]) == __FILE__) {

    // prog principal de test
    header('Content-Type:text/plain');

    echo "getUtilisateurs() : \n";
    print_r(getUsers());

    echo "getUtilisateurByMailU('mathieu.capliez@gmail.com') : \n";
    print_r(getUserByMail("mathieu.capliez@gmail.com"));

}
?>