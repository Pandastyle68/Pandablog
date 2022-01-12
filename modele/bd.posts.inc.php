<?php
include_once "bd.inc.php";

function getNbPosts()
{
    $cnx = connexionPDO();
    $sql = 'SELECT COUNT(*) AS nbPosts FROM `posts`;';

    // On prépare la requête
    $query = $cnx->prepare($sql);

    // On exécute
    $query->execute();

    // On récupère le nombre d'articles
    $result = $query->fetch();

    $nbPosts = (int) $result['nbPosts'];
    return $nbPosts;
}

function getNbPostsWTags($tags)
{
    $resultat = array();
    try {
        $cnx = connexionPDO();
        if ((count(explode(",", $tags)) > 1)) {
            $tags =  str_replace(" ", "", $tags);
            $multitags = explode(",", $tags);
            $req = ("SELECT COUNT(posts.id) AS nbPosts FROM posts JOIN postags ON posts.id = postags.idPost JOIN tags ON postags.idTags = tags.id WHERE UPPER(tags.label) IN (");
            for ($i = (int) 0; $i < (int) count($multitags); $i++) {
                $soltag = $multitags[$i];
                $req .= "UPPER('" . $multitags[$i] . "')";
                if ($i == count($multitags) - 1) {
                    $req .= ")GROUP BY posts.id HAVING COUNT(DISTINCT postags.idTags) =" . count($multitags);
                } else {
                    $req .= ",";
                }
            }
            $req = $cnx->prepare($req);
            $req->execute();

            $ligne = $req->fetch(PDO::FETCH_ASSOC);
            while ($ligne) {
                $resultat[] = $ligne;
                $ligne = $req->fetch(PDO::FETCH_ASSOC);
            }
            return $resultat;
        } else {
            $req = $cnx->prepare("SELECT COUNT(posts.id) AS nbPosts FROM posts JOIN postags ON posts.id = postags.idPost JOIN tags ON postags.idTags = tags.id WHERE UPPER(tags.label) LIKE UPPER(:tags)");
            $req->bindValue(':tags', $tags, PDO::PARAM_STR);
            $req->execute();

            $ligne = $req->fetch(PDO::FETCH_ASSOC);

            if (!is_bool($ligne)) {
                return $ligne['nbPosts'];
            } else {
                return 0;
            }
        }
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function addPosts($label, $desc, $cont, $idU)
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO posts VALUES(id, :label, :description, :content, NOW(), :idU, 0)");
        $req->bindValue(':label', $label, PDO::PARAM_STR);
        $req->bindValue(':description', $desc, PDO::PARAM_STR);
        $req->bindValue(':content', $cont, PDO::PARAM_STR);
        $req->bindValue(':idU', $idU, PDO::PARAM_STR);

        $req->execute();
        $lastId = $cnx->lastInsertId();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $lastId;
}

function getTagByLabel($labelT)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM tags WHERE UPPER(label) = UPPER(:label)");
        $req->bindValue(':label', $labelT, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function addPostTags($idT, $idP)
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO postags VALUES(:idT, :idP)");
        $req->bindValue(':idT', $idT, PDO::PARAM_STR);
        $req->bindValue(':idP', $idP, PDO::PARAM_STR);
        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function addTag($tagTxt, $nsfw)
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("INSERT INTO tags(label, nsfw)
        SELECT :tagTxt, :nsfw
        WHERE NOT EXISTS(SELECT label FROM tags WHERE label = :tagTxt)");
        $req->bindValue(':tagTxt', $tagTxt, PDO::PARAM_STR);
        $req->bindValue(':nsfw', $nsfw, PDO::PARAM_STR);
        $req->execute();
        $lastId = $cnx->lastInsertId();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $lastId;
}

function delPosts($idP)
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("DELETE FROM posts WHERE id = :idP");
        $req->bindValue(':idP', $idP, PDO::PARAM_STR);
        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function delPostTag($idP, $idT)
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("DELETE FROM postags WHERE idPost = :idP AND idTags = :idT");
        $req->bindValue(':idP', $idP, PDO::PARAM_STR);
        $req->bindValue(':idT', $idT, PDO::PARAM_STR);
        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getPosts($premier, $parPage)
{
    $resultat = array();
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT * FROM posts ORDER BY dateP desc LIMIT :premier, :parpage");
        $req->bindValue(':premier', $premier, PDO::PARAM_INT);
        $req->bindValue(':parpage', $parPage, PDO::PARAM_INT);

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

function getPostById($idP)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from posts where id=:idP");
        $req->bindValue(':idP', $idP, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getPostAuthor($idU)
{
    $resultat = array();

    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT DISTINCT usrname, mail FROM users JOIN posts ON users.id = posts.idUser WHERE idUser = :idU");
        $req->bindValue(':idU', $idU, PDO::PARAM_STR);
        $req->execute();

        $resultat = $req->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
    return $resultat;
}

function getPostTags($idP)
{
    $resultat = array();;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT tags.id, tags.label FROM tags JOIN postags ON tags.id = postags.idTags JOIN posts ON postags.idPost = posts.id WHERE idPost = :idP");
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

function getPostNsfw($idP)
{
    $resultat = array();;
    $bool = false;
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("SELECT tags.label FROM tags JOIN postags ON tags.id = postags.idTags JOIN posts ON postags.idPost = posts.id WHERE idPost = :idP AND tags.nsfw = 1");
        $req->bindValue(':idP', $idP, PDO::PARAM_STR);
        $req->execute();


        $ligne = $req->fetch(PDO::FETCH_ASSOC);
        while ($ligne) {
            $resultat[] = $ligne;
            $ligne = $req->fetch(PDO::FETCH_ASSOC);
        }
        if ($resultat != NULL) {
            if (count($resultat) > 0) {
                $bool = true;
            } else {
                $bool = false;
            }
        }
    } catch (PDOException $e) {
        print "Erreur ! NSFWPOST: " . $e->getMessage();
        die();
    }
    return $bool;
}

function getTags()
{
    $resultat = array();
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("select * from tags ");
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

function updateNsfwPost($idP, $nsfw)
{
    try {
        $cnx = connexionPDO();
        $req = $cnx->prepare("UPDATE posts SET posts.nsfw = :nsfw WHERE id = :idP");
        $req->bindValue(':idP', $idP, PDO::PARAM_STR);
        $req->bindValue(':nsfw', $nsfw, PDO::PARAM_STR);
        $req->execute();
    } catch (PDOException $e) {
        print "Erreur ! UPDATE NSFW: " . $e->getMessage();
        die();
    }
}

function getPostsByTags($tags, $premier, $parPage)
{
    try {
        $resultat = array();;
        $cnx = connexionPDO();
        if ((count(explode(",", $tags)) > 1)) {
            $tags =  str_replace(" ", "", $tags);
            $multitags = explode(",", $tags);
            $req = ("SELECT posts.label, posts.id, content, posts.nsfw, dateP FROM posts JOIN postags ON posts.id = postags.idPost JOIN tags ON postags.idTags = tags.id WHERE UPPER(tags.label) in (");
            for ($i = 0; $i < count($multitags); $i++) {
                $soltag = $multitags[$i];
                $req .= "UPPER('" . $multitags[$i] . "')";
                if ($i == count($multitags) - 1) {
                    $req .= ") GROUP BY posts.id, content, posts.nsfw, dateP HAVING COUNT(DISTINCT postags.idTags) =" . count($multitags) . " ORDER BY dateP desc LIMIT :premier, :parpage";
                } else {
                    $req .= ",";
                }
            }
            $req = $cnx->prepare($req);
            $req->bindValue(':premier', $premier, PDO::PARAM_INT);
            $req->bindValue(':parpage', $parPage, PDO::PARAM_INT);
        } else {
            $req = $cnx->prepare("SELECT posts.label, posts.id, content, posts.nsfw FROM posts JOIN postags ON posts.id = postags.idPost JOIN tags ON postags.idTags = tags.id WHERE UPPER(tags.label) LIKE UPPER(:tags) GROUP BY posts.id ORDER BY dateP DESC LIMIT :premier, :parpage");
            $req->bindValue(':tags', $tags, PDO::PARAM_STR);
            $req->bindValue(':premier', $premier, PDO::PARAM_INT);
            $req->bindValue(':parpage', $parPage, PDO::PARAM_INT);
        }


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
    if ($resultat != NULL) {
        return $resultat;
    }
}

if (str_replace('/', '\\', $_SERVER["SCRIPT_FILENAME"]) == __FILE__) {

    // prog principal de test
    header('Content-Type:text/plain');
}
