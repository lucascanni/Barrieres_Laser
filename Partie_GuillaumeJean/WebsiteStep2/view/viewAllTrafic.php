<?php
$title='Vue Trafic';

ob_start();  //On place en mémoire tampon tout ce qui suit

foreach($data as $laData):?>
    <h2><?= $laData->getId() ?></h2>
    <p><?=$laData->getIdVehicule() ?></p>
    <time><?=$laData->getDateTime() ?></time>
    <p><?=$laData->getValue() ?></p>
<?php endforeach;?>

<?php $content=ob_get_clean();
require ('template.php');