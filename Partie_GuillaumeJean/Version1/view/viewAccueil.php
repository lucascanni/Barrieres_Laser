<?php
$title = 'Vue accueil';

ob_start();  //On place en mémoire tampon tout ce qui suit
?>

<div class="content">
    <h1 class="accueil">Bienvenue sur le site de gestion des barrières laser du Cerema</h1>

    <img id="background_default" src=<?= Router::makeURL("public/img/siege_Cerema.jpg") ?> alt="">
    <img id="background_responsive" src=<?= Router::makeURL("public/img/cerema_responsive.jpg") ?> alt="">
</div>



<?php
$content = ob_get_clean();
require('template.php');
?>