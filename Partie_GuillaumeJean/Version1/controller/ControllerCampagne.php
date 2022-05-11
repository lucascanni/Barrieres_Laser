<?php

class ControllerCampagne
{
    private $campagneManager;

    public function __construct($url = null)
    {
        $this->campagneManager = new CampagneManager;

        if (isset($url) && count($url) == 1) {
            $this->allCampagne();
            return;
        }

        if (isset($url) && count($url) == 2 && $url[1] == "new") {
            $titre = "Nouvelle Campagne";
            $title = "Nouvelle campagne";
            require_once 'view/viewNewCampagne.php';
            return;
        } else if (isset($url) && count($url) == 2 && $url[1] == "newAnswer") {
            $this->newCampagne();
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
            $this->campagneManager->deleteCampagne($url[2]);
            $this->allCampagne();
            return;
        }
        
    }

    private function newCampagne()
    {
        $validator = new Validator($_POST);
        $db = $this->campagneManager->getBdd();

        //Nom dans l'alphabet
        if (!$validator->isAlpha('nomCampagne', 'Nom de campagne invalide')) {
            throw new Exception($validator->getErrors());
            return;
        }
        //Nom Disponible
        if (!$validator->isUnique('nomCampagne', $db, 'campagne', 'Nom déjà utilisé')) {
            throw new Exception($validator->getErrors());
            return;
        }

        //A ce stade tout est ok donc on peut stocker l'utilisateur dans la BDD
        $this->campagneManager->registerNewCampagne($_POST);
        $this->allCampagne();
    }


    private function allCampagne()
    {
        $data = $this->campagneManager->getAllCampagne();
        $titre = "Liste des Campagnes de mesures";
        $sousTitres = "Voici tous les campagnes";
        require_once 'view/viewAllCampagne.php';
        return;
    }
}