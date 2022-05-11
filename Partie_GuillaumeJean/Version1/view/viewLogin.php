<?php
ob_start();
?>

<h1><?= $titre ?> :<br> Connectez-vous</h1>
<div class=form-signin>
    <form action="<?= Router::makeURL("user/loginAnswer") ?>" method=POST>
        <label for="input">Pseudo</label>
        <input type="text" id="login" name="login" placeholder="Pseudo" required autofocus>
        <label for="inputPassword">Password</label>
        <input type="password" id="inputPassword" name="password" placeholder="Mot de passe" required>

        <button type="submit">Se connecter</button>
        <p>&copy; 2017-2020</p>
    </form>
</div>
<?php
$content = ob_get_clean();
require('template.php');
