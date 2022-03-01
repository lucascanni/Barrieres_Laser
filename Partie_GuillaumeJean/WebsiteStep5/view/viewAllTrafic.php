<?php
$title='Vue Trafic';

ob_start();  //On place en mémoire tampon tout ce qui suit
?>
<div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th scope="col">ID</th>
              <th scope="col">ID Véhicule</th>
              <th scope="col">Instant d'aquisition</th>
              <th scope="col">Vitesse</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($data as $laData):?>
            <tr>
              <td><?= $laData->getId() ?></td>
              <td><?= $laData->getIdVehicule() ?></td>
              <td><?=$laData->getDateTime() ?></td>
              <td><?=$laData->getValue() ?> Km/h</td>
            </tr>
            <?php endforeach;?>
          </tbody>
        </table>
      </div>

<?php $content=ob_get_clean();
require ('template.php');