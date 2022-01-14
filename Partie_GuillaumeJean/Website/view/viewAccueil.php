<?php
$title='Vue accueil';

ob_start();  //On place en mémoire tampon tout ce qui suit
?>

<h2>Notre site MVC pour CEREMA</h2>
<p>Bienvenue à tous sur notre premier site MVC</p>

<?php
$content = ob_get_clean();
require('template.php');
?>