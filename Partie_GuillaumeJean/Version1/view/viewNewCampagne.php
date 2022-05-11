<?php
ob_start();
?>

<div class=form-newCampagne>
    <form action="<?=Router::makeURL("campagne/newAnswer")?>" method=POST>
        <h1 class="Titre">Crééz une nouvelle campagne</h1>
        <label for="input">Nom de la campagne</label>
        <input type="text" id="CampagneName" name="nomCampagne" placeholder="Nom de la campagne" required autofocus><br>
        <label for="input">Description de la campagne</label>
        <input type="text" id="DescriptionCampagne" name="description" placeholder="Description de la campagne" required autofocus><br>
        <label for="inputDate" >Date de campagne</label>
        <input style="width:10%;" type="date" id="CompagneDate" name="dateCampagne" placeholder="(AAAA/MM/JJ HH/MM)" required>

        <button type="submit">Créer la campagne</button>
    </form>
</div>
<?php
$content=ob_get_clean();
require ('template.php');