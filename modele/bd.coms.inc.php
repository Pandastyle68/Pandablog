<?php
include_once "bd.inc.php";

function getComsByPostId($idP) {
    $resultat = array();
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT coms.id, content, dateC, usrname FROM users JOIN coms ON users.id = coms.idUser WHERE idPost = :idP");
        $req->bindValue(':idP', $idP, PDO::PARAM_STR);
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

function remComs($idC) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("DELETE FROM coms WHERE id = :idC");
        $req->bindValue(':idC', $idC, PDO::PARAM_STR);
        $req->execute();


    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function addCom($contentCom, $idAuthorCom, $idPCom) {
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO coms VALUES(id, :content , NOW(), :idAuthor , :idP)");
        $req->bindValue(':content', $contentCom, PDO::PARAM_STR);
        $req->bindValue(':idAuthor', $idAuthorCom, PDO::PARAM_STR);
        $req->bindValue(':idP', $idPCom, PDO::PARAM_STR);
        $req->execute();


    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

?>