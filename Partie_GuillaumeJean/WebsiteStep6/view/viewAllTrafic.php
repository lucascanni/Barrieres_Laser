<?php
$title = 'Vue Trafic';

ob_start();  //On place en mémoire tampon tout ce qui suit
?>

<script type="text/javascript">
  var lesDates=<?= json_encode($lesDates) ?>;
  var lesMesures=<?= json_encode($lesMesures) ?>;
</script>


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

      <?php foreach ($data as $laData) : ?>
        <tr>
          <td><?= $laData->getId() ?></td>
          <td><?= $laData->getIdVehicule() ?></td>
          <td><?= $laData->getDateTime() ?></td>
          <td><?= $laData->getValue() ?> Km/h</td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<canvas id="myChart" width="400" height="400"></canvas>
<?php $content = ob_get_clean();
require('template.php');
