<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="\Version1\bootstrap\bootstrap-5.1.3-dist\css\bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href=<?= Router::makeURL("public/css/main.css") ?>>
    <link rel="stylesheet" href=<?= Router::makeURL("public/css/table.css") ?>>
    <link rel="stylesheet" href=<?= Router::makeURL("fontawesome/fontawesome-free-5.15.4-web/fontawesome-free-5.15.4-web/css/all.css") ?> >
    <title><?= $title ?></title> <!-- La balise ?= remplace la balise ?php echo ; elle est plus rapide d'écrite -->

    <script src = <?= Router::makeURL("libraries/jquery-3.6.0.min.js") ?>></script>
    <script src = <?= Router::makeURL("libraries/popper.min.js") ?>></script>
</head>

<body>
    <header class="topbar">
        <a class="topbar_item" href="#" id="openBtn">
            <span class="burger-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>
        <div class="topbar_item">
            <?php
            //Message de bienvenue pour les utilisateurs
            if (UserManager::level() > 0)
                echo "Bonjour " . $_SESSION["connectedUser"][0];
            ?>
        </div>

        <a class="topbar_item" id="log" href="<?php
                                                //Lien vers la page de connexion ou déconnexion
                                                if (UserManager::level() > 0)
                                                    echo Router::makeURL("user/logout");
                                                else
                                                    echo Router::makeURL("user/login");
                                                ?>">
            <?php
            if (UserManager::level() > 0)
                echo "Deconnexion";
            else
                echo "Connexion";
            ?>
        </a>
    </header>

    <div id="mySidenav" class="sidenav">
        <a id="closeBtn" href="#" class="close">&times;</a>
        <ul>
            <li><a href=<?= Router::makeURL("index.php") ?>><span data-feather="home"></span>Accueil</a></li>
            <li><a aria-current="page" href=<?= Router::makeURL("laser/last") ?>><span data-feather="home"></span>Dernière acquisition</a></li>
            <li><a href="<?= Router::makeURL("laser") ?>"><span data-feather="file"></span>Historique d'aquisition</a></li>
            <?php
            if (UserManager::level() == 2) {
            ?>
                <li>
                    <a href="<?= Router::makeURL("user") ?>">
                        <span data-feather="file"></span>
                        Gestionnaire Utilisateur
                    </a>
                </li>
            <?php } ?>
            <li><a href="#"><span data-feather="file"></span>A propos</a></li>
        </ul>
    </div>


    <div class="banniere">
        <a href=<?= Router::makeURL("index.php") ?>><img class="ban-content" src=<?= Router::makeURL("public/img/LogoCerema.png") ?> alt=""></a>
    </div>

    <!-- C'est ici que vient se gréffer le contenu du bloc associé -->
    <main>
        <?= $content ?>
    </main>

    <!-- Footer -->

    <!-- <footer>
        <p>&copy; Crée par le groupe de projet barrière laser du BTS Snir2 CDF</p>
    </footer> -->




    <script src=<?= Router::makeURL("public/js/sidebar.js") ?>></script>
    <script src="../bootstrap/js/bootstrap.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>

</html>