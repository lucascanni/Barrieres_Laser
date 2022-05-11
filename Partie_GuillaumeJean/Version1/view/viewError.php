<?php
$title='Vue accueil';

ob_start();  //On place en mémoire tampon tout ce qui suit
?>

<h2>Page Erreur</h2>
<h2><?=$errorMsg?></h2>

<?php
$content = ob_get_clean();
require('template.php');
?>