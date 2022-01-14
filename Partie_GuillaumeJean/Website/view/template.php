<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>        <!-- La balise ?= remplace la balise ?php echo ; elle est plus rapide d'écrite -->
</head>
<body>
    <header>
        <h1>Bienvenue sur mon site MVC</h1>
    </header>

    <!-- C'est ici que vient se gréffer le contenu du bloc associé -->
    <?= $content ?>

    <footer>
        <p>Crée par le groupe de projet barrière laser du BTS Snir2 CDF</p>
    </footer>



    
</body>
</html>