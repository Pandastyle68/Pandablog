<!DOCTYPE html>
<?php if (!isset($_COOKIE['acceptNsfw'])) : setcookie("acceptNsfw", 0);
header("Refresh:0");
endif ?>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="js/main.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="shortcut icon" href="images/favicon.png">
    <link rel="stylesheet" href="css/addstyle.css">

    <title><?= $titre ?></title>
</head>

<body>
    <header class="header">
        <nav class="navbar navbar-expand-lg fixed-top py-3">
            <div class="container"><a href="./?page=posts" class="navbar-brand text-uppercase font-weight-bold">Pandabooru</a>
                <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler navbar-toggler-right"><i class="fa fa-bars"></i></button>

                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active"><a href="./?page=posts" class="nav-link text-uppercase font-weight-bold">Accueil <span class="sr-only">(current)</span></a></li>
                        <?php
                        if (isset($_SESSION['mailU'])) {
                        ?>
                            <?php
                            if (isset($_SESSION['access']) and ($_SESSION['access'] <= 3)) {
                            ?>
                                <li class="nav-item">
                                    <a href="./?page=newpost" class="nav-link text-uppercase font-weight-bold">Créer un post</a>
                                </li>
                                <li class="nav-item">
                                    <a href="./?page=newtags" class="nav-link text-uppercase font-weight-bold">Créer des tags</a>
                                </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a href="./?page=disconnect" class="nav-link text-uppercase font-weight-bold">Se déconnecter</a>
                            </li>
                        <?php
                        } else {
                        ?>
                            <li class="nav-item">
                                <a href="./?page=signup" class="nav-link text-uppercase font-weight-bold">S'inscrire</a>
                            </li>
                            <li class="nav-item">
                                <a href="./?page=signin" class="nav-link text-uppercase font-weight-bold">Se connecter</a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item">
                            <a onclick="updateNsfwUser()" class="nav-link text-uppercase font-weight-bold">Toggle NSFW</a>
                        </li>
                        <script>
                            function updateNsfwUser() {
                                const cookieValue = document.cookie
                                    .split('; ')
                                    .find(row => row.startsWith('acceptNsfw='))
                                    .split('=')[1];
                                if (cookieValue == 1) {
                                    document.cookie = "acceptNsfw=0";
                                    location.reload();
                                } else {
                                    document.cookie = "acceptNsfw=1";
                                    location.reload();
                                }
                            }
                        </script>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <br>
    <br>
    <script>
        $(function() {
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 10) {
                    $('.navbar').addClass('active');
                } else {
                    $('.navbar').removeClass('active');
                }
            });
        });
    </script>