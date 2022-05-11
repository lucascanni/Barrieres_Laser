<?php
ob_start();
$title = "Liste Campagnes";
?>

<h2><?=$titre?></h2>
<div>
    <table>
        <thead>
            <tr>
                <th scope="col">Nom de campagne</th>
                <th scope="col">Description</th>
            </tr>
        </thead>
        <tbody>

        <?php
        foreach ($data as $laData): ?>
            <tr>
                <td>
                    <a href=<?=Router::makeURL("user/campagne/".$laData->getNomCampagne())?> >
                        <?=$laData->getNomCampagne() ?>
                    </a>
                </td>
                <td>
                    <?= $laData->getDescription() ?>
                </td>
                <td>
                    <input type="button" name="Supprimer" value="Supprimer" onClick="window.location.href='<?=Router::makeURL("campagne/delete/".$laData->getNomCampagne())?>';" />
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<?php
$content=ob_get_clean();
require ('template.php');