<?php
if (str_replace('/', '\\', $_SERVER["SCRIPT_FILENAME"]) == __FILE__) {

    $racine = "..";
}
$user = getUserByMail($_SESSION['mailU']);
$idU = $user['id'];

include_once "$racine/modele/bd.posts.inc.php";
include_once "$racine/modele/bd.utilisateur.inc.php";
require "$racine/vendor/autoload.php";

if (isset($_FILES['imagesend'])) {
    $sec = 0;
    $allowedExts = array("jpg", "jpeg", "gif", "png", "mp3", "mp4", "wav", "wma", "mov", "MOV", "webm", "mkv");
    $extension = pathinfo($_FILES['imagesend']['name'], PATHINFO_EXTENSION);

    if ((($_FILES["imagesend"]["type"] == "video/mp4")
            || ($_FILES["imagesend"]["type"] == "video/x-matroska")
            || ($_FILES["imagesend"]["type"] == "video/quicktime")
            || ($_FILES["imagesend"]["type"] == "video/webm")
            || ($_FILES["imagesend"]["type"] == "video/mov")
            || ($_FILES["imagesend"]["type"] == "audio/mpeg")
            || ($_FILES["imagesend"]["type"] == "audio/wma")
            || ($_FILES["imagesend"]["type"] == "audio/wav")
            || ($_FILES["imagesend"]["type"] == "image/pjpeg")
            || ($_FILES["imagesend"]["type"] == "image/png")
            || ($_FILES["imagesend"]["type"] == "image/gif")
            || ($_FILES["imagesend"]["type"] == "image/jpeg"))
        && ($_FILES["imagesend"]["size"] < 100000000000)
        && in_array($extension, $allowedExts)
    ) {
        if ($_FILES["imagesend"]["error"] > 0) {
            echo "Return Code: " . $_FILES["imagesend"]["error"] . "<br />";
        } else {
            if (file_exists("upload/" . $_FILES["imagesend"]["name"])) {
            } else {
                if (($_FILES["imagesend"]["type"] == "video/mp4")
                    || ($_FILES["imagesend"]["type"] == "video/quicktime")
                    || ($_FILES["imagesend"]["type"] == "video/webm")
                    || ($_FILES["imagesend"]["type"] == "image/gif")
                    || ($_FILES["imagesend"]["type"] == "video/mov")
                ) {
                    $movie = $_FILES["imagesend"]["tmp_name"];
                    $thumbnail = 'thumbnail_' . $_FILES["imagesend"]["name"] . '.jpg';
                    $ffmpeg = FFMpeg\FFMpeg::create(array(
                        'ffmpeg.binaries'  => 'C:/ffmpeg/ffmpeg.exe',
                        'ffprobe.binaries' => 'C:/ffmpeg/ffprobe.exe',
                        'timeout'          => 3600, // The timeout for the underlying process
                        'ffmpeg.threads'   => 12,   // The number of threads that FFMpeg should use
                    ));
                    $video = $ffmpeg->open($movie);
                    $frame = $video->frame(FFMpeg\Coordinate\TimeCode::fromSeconds($sec));
                    $frame->save("$racine/images/" . $thumbnail, true);
                }
                move_uploaded_file($_FILES["imagesend"]["tmp_name"], "$racine/images/" . $_FILES["imagesend"]["name"]);
                $lien = "images/" . $_FILES['imagesend']['name'];
                if (!(($_FILES["imagesend"]["type"] == "video/mp4")
                    || ($_FILES["imagesend"]["type"] == "video/quicktime")
                    || ($_FILES["imagesend"]["type"] == "video/webm")
                    || ($_FILES["imagesend"]["type"] == "image/gif")
                    || ($_FILES["imagesend"]["type"] == "video/mov")
                )){
                    makeThumbnails("$racine/images/", $lien);
                }
                if (isset($_POST['label']) & isset($_POST['description'])) {
                    if (($_POST['content'] != "")) {
                        $idP = addPosts($_POST['label'], $_POST['description'], $_POST['content'], $idU);
                        if (isset($_POST['selectedTags'])) {
                            $tagsArray = explode(",", $_POST['selectedTags']);
                            foreach ($tagsArray as $unTag) {
                                $idT = addTag($unTag, 1);
                                if ($idT == 0) {
                                    $idT = getTagByLabel($unTag);
                                    addPostTags($idT['id'], $idP);
                                } else {
                                    addPostTags($idT, $idP);
                                }
                            }
                        } else {
                            addPostTags(8, $idP);
                        }
                    } else {
                        $idP = addPosts($_POST['label'], $_POST['description'], $lien, $idU);
                        if (isset($_POST['selectedTags'])) {
                            $tagsArray = explode(",", $_POST['selectedTags']);
                            foreach ($tagsArray as $unTag) {
                                $idT = addTag($unTag, 1);
                                if ($idT == 0) {
                                    $idT = getTagByLabel($unTag);
                                    addPostTags($idT['id'], $idP);
                                } else {
                                    addPostTags($idT, $idP);
                                }
                            }
                        } else {
                            addPostTags(8, $idP);
                        }
                    }
                    include_once "$racine/controleur/redirect.php";
                } else {
                    $titre = "Nouveau post";
                    include "$racine/vue/entete.html.php";
                    $lesTags = getTags();
                    include "$racine/vue/vueCreaPost.php";
                    include "$racine/vue/pied.html.php";
                }
            }
        }
    } else {
        echo $_FILES["imagesend"]["type"];
        if (isset($_POST['label']) & isset($_POST['description'])) {
            if (isset($_POST['content'])) {
                $idP = addPosts($_POST['label'], $_POST['description'], $_POST['content'], $idU);
                if (isset($_POST['selectedTags'])) {
                    $tagsArray = explode(",", $_POST['selectedTags']);
                    foreach ($tagsArray as $unTag) {
                        $idT = addTag($unTag, 1);
                        if ($idT == 0) {
                            $idT = getTagByLabel($unTag);
                            addPostTags($idT['id'], $idP);
                        } else {
                            addPostTags($idT, $idP);
                        }
                    }
                    include_once "$racine/controleur/redirect.php";
                } else {
                    addPostTags(8, $idP);
                }
            }
        }
    }
} else {
    if (isset($_POST['label']) & isset($_POST['description'])) {
        if (isset($_POST['content'])) {
            $idP = addPosts($_POST['label'], $_POST['description'], $_POST['content'], $idU);
            if (isset($_POST['selectedTags'])) {
                $tagsArray = explode(",", $_POST['selectedTags']);
                foreach ($tagsArray as $unTag) {
                    $idT = addTag($unTag, 1);
                    if ($idT == 0) {
                        $idT = getTagByLabel($unTag);
                        addPostTags($idT['id'], $idP);
                    } else {
                        addPostTags($idT, $idP);
                    }
                }
            } else {
                addPostTags(8, $idP);
            }
        }
        include_once "$racine/controleur/redirect.php";
        include "$racine/vue/entete.html.php";
    } else {
        $titre = "Nouveau post";
        include "$racine/vue/entete.html.php";
        $lesTags = getTags();
        include "$racine/vue/vueCreaPost.php";
        include "$racine/vue/pied.html.php";
    }
}

// recuperation des donnees GET, POST, et SESSION
include_once "$racine/controleur/updateNsfw.php";
