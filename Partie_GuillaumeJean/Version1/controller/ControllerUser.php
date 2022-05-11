<?php

class ControllerUser
{
    private $userManager;

    public function __construct($url = null)
    {
        $this->userManager = new UserManager;

        if (isset($url) && count($url) == 2 && $url[1] == "login") {
            $titre = "Connexion ";
            require_once 'view/viewLogin.php';
            return;
        } else if (isset($url) && count($url) == 1) {
            $this->allUsers();
            return;
        }

        if (isset($url) && count($url) == 2 && $url[1] == "new") {
            $titre = "Nouvel Utilisateur ";
            $title = "Nouvel Utilisateur";
            require_once 'view/viewNewUser.php';
            return;
        } else if (isset($url) && count($url) == 2 && $url[1] == "newAnswer") {
            $this->newUser();
            return;
        }
        else if (isset($url) && count($url)==3 && $url[1]=="delete")
        {
            if (UserManager::level()==0)
            {
                throw new Exception("Veuillez vous connecter");
                return;
            }
            if (UserManager::level()!=2)
            {
                throw new Exception("Il vous faut les droits d'administration pour pouvoir accéder à cette page");
                return;
            }
            $this->userManager->deleteUser($url[2]);
            $this->allUsers();
            return;
        }

        //Si URL est de type site/user/loginAnswer alors c'est qu'on vient de se connecter
        else if (isset($url) && count($url) == 2 && $url[1]=='loginAnswer')
        {
            $retour=$this->userManager->login($_POST['login'],$_POST['password']);
            if (! $retour)
            {
                $_SESSION["connexion"]=false;
                $errorMsg="Erreur de connexion";
                require_once 'view/viewError.php';
                return;
            }
            //Login = ok
            $_SESSION['connexion']=true;
            $_SESSION['connectedUser']=$retour;
            require_once 'view/viewAccueil.php';
            return;
        }

        //Si URL est de type site/user/logout c'est qu'on vient de se déconnecter
        else if (isset($url) && count($url) == 2 && $url[1]=="logout")
        {
            $_SESSION["connexion"]=false;
            $titre = "Déconnexion effectuée";

            require_once 'view/viewLogout.php';
            return;

        }
    }

    private function newUser()
    {
        $validator = new Validator($_POST);
        $db = $this->userManager->getBdd();

        //Pseudo dans l'alphabet
        if (!$validator->isAlpha('login', 'Pseudo Invalide')) {
            throw new Exception($validator->getErrors());
            return;
        }
        //Pseudo Disponible
        if (!$validator->isUnique('login', $db, 'utilisateur', 'Pseudo déjà utilisé')) {
            throw new Exception($validator->getErrors());
            return;
        }
        //Mots de passe sont identique
        if (!$validator->isConfirmed('password', "Vous devez saisir un mot de passe identique")) {
            throw new Exception($validator->getErrors());
            return;
        }

        //A ce stade tout est ok donc on peut stocker l'utilisateur dans la BDD
        $this->userManager->registerNewUser($_POST);
        $this->allUsers();
    }


    private function allUsers()
    {
        $data = $this->userManager->getAllUsers();
        $titre = "Liste des Utilisateurs";
        $sousTitres = "Voici tous les utilisateurs";
        require_once 'view/viewAllUsers.php';
        return;
    }
}
