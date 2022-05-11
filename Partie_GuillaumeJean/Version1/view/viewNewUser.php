<?php
ob_start();
?>

<h2><?=$titre?></h2>

    <form action="<?=Router::makeURL("user/newAnswer")?>" method=POST>
        <div>
            <input type="checkbox" value="0" id="flexCheckDefault" name="priorite">
            
            <label for="flexCheckDefault" >Administrateur</label>
        </div>
        <div>
            <input type="text" name="login" placeholder="Choisir un pseudo">
        </div>
        <div>
            <input type="password" name="password" placeholder="Choisir un mot de passe">
        </div>
        <div>
            <input type="password" name="password_confirm" placeholder="Confirmez le mot de passe">
        </div>
        
        <button>Validez les changements</button>
        <input type="button" name="Annuler" value="Annuler" onclick="window.location.href='<?=Router::makeURL("user")?>';"'/>
    </form>
<?php
$content=ob_get_clean();
require ('template.php');