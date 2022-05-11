<?php
class UserManager extends Model {

    /*=========================
        Constructeur
    ==========================*/
    public function __construct() {
        $this->setBdd('version1_alpha');
    }

    /*=======================================================================================================
        Enregistrement d'un nouvel utilisateur dans la table indiquée avec les arguments fournis pa $POST
    =========================================================================================================*/
    public function registerNewUser($POST) {
        //On génère le hachage du mot de passe ne sera pas haché deux fois 
        // de la même manière car password_hash applique un salage de 
        // votre mot de passe avant de le hacher, c'est à dire qu'il 
        // concatène le mot de passe avec une chaîne aléatoire elle même
        //incluse (encodée en base 64) dans le hachage obtenu 
        $password=password_hash($POST['password'], PASSWORD_BCRYPT);

        if (isset($POST['priorite']))
            $privileges=2;
        else 
            $privileges=1;

        $sql="INSERT INTO utilisateur SET login ='".$POST['login']."', password='".$password."', privileges=".$privileges;
        //var_dump($sql);die();
        $req=$this->getBdd()->query($sql);
    }


    /*==========================================================
    Récupération de tous les utilisateurs
    ==========================================================*/
    public function getAllUsers()
    {
        $var=[];
        $var=$this->getAll("utilisateur","User");
        return $var;
    }

    /*==========================================================
    Supression d'un utilisateur
    ==========================================================*/
    public function deleteUser($pseudo)
    {
        $sql="DELETE FROM utilisateur WHERE login='".$pseudo."'";
        $this->getBdd()->query($sql);
    }

    /*==========================================================
    Supression d'un utilisateur
    ==========================================================*/
    public function login ($login, $password) {
        $sql="SELECT * FROM utilisateur WHERE login='".$login."'" ;
        $user=$this->getBdd()->query($sql)->fetch();
        if ($user && password_verify($password, $user['password'])) {
            return array($user['login'], $user['privileges']);
        }
        else {
            return 0;
        }
    }

    /*==========================================================
    Donne le niveau d'autorisation d'un utilisateur 
    0 : non connecté
    1 : consultant
    2 : administrateur
    ==========================================================*/
    public static function level () {
        if(! isset($_SESSION["connexion"]) || $_SESSION["connexion"]==false) 
            return 0;

        return  $_SESSION["connectedUser"][1];
    }



}