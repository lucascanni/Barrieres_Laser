<?php
$title = 'Vue Trafic';

ob_start();  //On place en mémoire tampon tout ce qui suit
?>
<div class="content">
  <img id="background_default_bis" src=<?= Router::makeURL("public/img/cerema_responsive.jpg") ?> alt="">

  <table>
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Instant d'aquisition</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($data as $laData) : ?>
        <tr>
          <td>
            <a class="donnees" href=<?= Router::makeURL("laser/" . $laData->getId()) ?>>
              <?= $laData->getId() ?>
          </td>
          </a>
          </td>

          <td>
            <a class="donnees" href=<?= Router::makeURL("laser/" . $laData->getId()) ?>>
              <?= $laData->getDateTime() ?>
            </a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<div class="images">
  <a class="lien_voiture" href=""><img class="img_voiture" src=<?= Router::makeURL("photos/test.jpg") ?>></a>
  <a class="lien_voiture" href=""><img class="img_voiture" src=<?= Router::makeURL("photos/test2.jpg") ?>></a>
</div>




<!-- Module affichage image -->
<!-- <?php if (count($url) == 2) {
        //var_dump(getcwd());die();
        $date = $laData->getDateTime();
        $id = $laData->getId();
        $FileName = $id . '_' . $date;
        $src = "'./img/Photos/$FileName";
        $src = str_replace(" ", "_", $src);
        $src1 = $src . "_CAM1.jpg'";
        $src2 = $src . "_CAM2.jpg'";

        echo "<a href=\"youtube.com\">
          <img src=$src1 width=\"30%\">
        </a>";
        echo "<a href=\"youtube.com\">
          <img src=$src2 width=\"30%\">
        </a>";
      }
      ?> -->


<?php $content = ob_get_clean();
require('template.php');
