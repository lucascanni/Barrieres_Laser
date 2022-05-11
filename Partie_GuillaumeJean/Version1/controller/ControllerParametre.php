<?php

class ControllerParametre
{
    private $parametreManager;

    public function __construct($url = null)
    {
        $this->parametreManager = new ParametresManager;


        if (UserManager::level() == 0) {
            throw new Exception("Veuillez vous connecter");
            return;
        }
        if (UserManager::level() != 2) {
            throw new Exception("Il vous faut les droits d'administration pour pouvoir accéder à cette page");
            return;
        }
        if (isset($url) && count($url) == 1) {
            $this->allParametres();
            return;
        }
    }

    private function allParametres()
    {
        $data = $this->parametreManager->getAllParametres();
        $titre = "Liste des paramètres";
        $sousTitres = "Voici tous les paramètres";
        require_once 'view/viewAllParametre.php';
        return;
    }
}
