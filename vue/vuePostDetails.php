<br>
<div class="container d-flex justify-content-center">
    <div class="jumbotron video-player" style="background-color: #292b2e">
        <div class="d-flex justify-content-center text-white">
            <h1><?= $lePost['label'] ?></h1>
            <?php $leContent = $lePost['content']; ?>
        </div>
        <div class="d-flex justify-content-center">
            <div class="card bg-dark" style="width:100%">
                <?php if (strpos($leContent, ".png") | strpos($leContent, ".jpg") | strpos($leContent, ".jpeg") | strpos($leContent, ".gif")) { ?>
                    <a href="<?= $leContent ?>"><img class="card-img-top img-fluid" src="<?= $leContent ?>" class="img-fluid img-thumbnail" alt="Image Post" width="600" height="600"></a>
            </div>
        <?php } else if (strpos($leContent, ".mp3")) { ?>
            <br>
            <div class="d-flex justify-content-center audio-container" id="audio-player-container" style="height:100%">
                <canvas id="projector"></canvas>
                <script src="https://code.createjs.com/1.0.0/easeljs.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.19.1/TweenMax.min.js"></script>
                <div class="audio-button-container">
                    <audio id="myAudio" src="<?= $leContent ?>">
                        Your browser does not support the
                        <code>audio</code> element.
                    </audio>
                    <button class="button-play" type="button" width="5%" style="z-index: 2; margin-top:20px" onclick="aud_play_pause()"><img id="audioImage" src="../ressources/play.png" type="image/jpeg" alt="Image Post" width="25%" height="25%"></button>
                    <div class="d-flex justify-content-center" style="margin-top: 20px;">
                        <label id="volLabel" for="volume-control" style="margin-top: 20px; z-index: 1;">vol</label>
                        <input class="audio-control" type="range" id="volume-control" oninput="changeVol()" value=100>
                        <script>
                            var labVol = document.getElementById("volLabel");
                            var volCont = document.getElementById("myAudio");
                            labVol.innerHTML = Math.round((volCont.volume * 100)) + "%";
                        </script>
                    </div>
                    <div class="d-flex justify-content-center">
                        <h3 id="currTime" style="z-index: 1;"></h3>
                        <canvas id='progress-bar' style="color: blue;z-index: 1">canvas not supported</canvas>
                        <h3 id="totTime" style="z-index: 1;"></h3>
                    </div>
                    <script src="js/audio.js"></script>
                </div>
            </div>

        <?php } else { ?>
            <video id="post-player" class="video-js center" controls preload="auto" width="100%" height="100%" data-setup="{}">
                <source src="<?= $leContent ?>" type="video/mp4" />
            </video>
            <script src="https://cdn.fluidplayer.com/v3/current/fluidplayer.min.js"></script>

            <script>
                // fluidPlayer method is global when CDN distribution is used.
                var myFP = fluidPlayer(
                    'post-player', {
                        "layoutControls": {
                            "autoPlay": false,
                            "mute": true,
                            "allowTheatre": true,
                            "allowDownload": true,
                            "playButtonShowing": false,
                            "fillToContainer": true,
                            "posterImage": ""
                        },
                        "vastOptions": {
                            "adList": [],
                            "adCTAText": false,
                            "adCTATextPosition": ""
                        }
                    });
            </script>
        </div>
    <?php } ?>
    </div>
</div>
<div class="d-flex justify-content-center text-white">

</div>
</div>
<div class="jumbotron" style="background-color: #292b2e">
    <h2>By: <?= $pAuthor['usrname'] ?></h2>
    <div class="d-flex justify-content-center text-white">
        <h3><?= $lePost['description'] ?></h1>
    </div>
</div>
<div class="d-flex justify-content-center text-white">
    <?php if (isset($_SESSION['mailU'])) { ?>
        <?php if ($pAuthor['mail'] == $_SESSION['mailU'] || $_SESSION['access'] >= 3) { ?>
            <form action="" method="post">
                <input class="btn btn-danger " id="postauthor-remove" type="submit" name="submit" value="Supprimer Post">
                <a href="./?page=tags&id=<?= $lePost['id'] ?>" type="button" class="btn btn-secondary">Changer les tags</a>
            </form>
    <?php }
    } ?>
</div>
<br>
</div>
</div>
<hr>
<?php if ($lesTags != "") { ?>
    <div class="d-flex justify-content-center text-white tag-container">
        <?php $countTag = 0;
        foreach ($lesTags as $unTag) : $countTag++;
            $unLabelTag = str_replace("( ", "(", ucwords(str_replace("(", "( ", str_replace("_", " ", $unTag['label'])))); ?>
            <a href="./?tags=<?= $unTag['label'] ?>" type="button" class="btn btn-secondary btn-sm tag-but nowrap"><?= $unLabelTag ?></button></a>
            <?php if ($detect->isMobile()) :
                if ($countTag % 2 == 0) : ?>
    </div>
    <div class="d-flex justify-content-center text-white tag-container">
    <?php
                endif;
            else :
                if ($countTag % 4 == 0) : ?>
    </div>
    <div class="d-flex justify-content-center text-white tag-container">
<?php endif;
            endif; ?>
<?php endforeach ?>
    </div>
    <hr>
<?php } ?>
<div class="d-flex justify-content-center text-white">
    <h2>Commentaires : </h2>
</div>
<div class="container">
    <div class="jumbotron" style="background-color: #292b2e">
        <div class="d-flex justify-content-center text-white">
            <form action="" class="was-validated" method="post">
                <label for="comcontent" class="col-4 col-form-label">Commentaire</label>
                <textarea id="comcontent" name="comcontent" cols="40" rows="5" class="form-control" required="required"></textarea>
                <button name="submit" type="submit" class="btn btn-pandabooru center btn-primary">Soumettre</button>
            </form>
        </div>
    </div>
</div>
<div class="container">
    <?php if ($lesComs != "") {
        foreach ($lesComs as $unCom) {  ?>


            <div class="jumbotron" style="background-color: #292b2e">
                <div class="d-flex justify-content-center text-white">
                    <h2><?= $unCom['content'] ?></h2>
                </div>
                <div class="d-flex justify-content-center text-white">
                    <h2>By: <?= $unCom['usrname'] ?></h2>
                    <?php if (isset($_SESSION['mailU'])) { ?>
                        <?php if ($pAuthor['mail'] == $_SESSION['mailU'] || $_SESSION['access'] >= 3) { ?>
                            <form action="" method="post">
                                <input class="btn btn-pandabooru btn-danger" id="post-remove" type="submit" name="submit" value="<?= $unCom['id'] ?>">
                            </form>
                    <?php }
                    } ?>
                </div>
            </div>

    <?php }
    } ?>
</div>