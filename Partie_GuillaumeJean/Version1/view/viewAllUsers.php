<?php
ob_start();
$title = "Liste Utilisateur";
?>

<h2><?=$titre?></h2>
<div>
    <table>
        <thead>
            <tr>
                <th scope="col">Pseudo</th>
                <th scope="col">Priorité</th>
            </tr>
        </thead>
        <tbody>

        <?php
        foreach ($data as $laData): ?>
            <tr>
                <td>
                    <a href=<?=Router::makeURL("user/pseudo/".$laData->getLogin())?> >
                        <?=$laData->getLogin() ?>
                    </a>
                </td>
                <td>
                    <?= $laData->getPrivileges() ?>
                </td>
                <td>
                    <input type="button" name="Supprimer" value="Supprimer" onClick="window.location.href='<?=Router::makeURL("user/delete/".$laData->getLogin())?>';" />
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>

<?php
$content=ob_get_clean();
require ('template.php');