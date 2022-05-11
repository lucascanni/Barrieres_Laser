<?php
class ParametresManager extends Model {

    /*=========================
        Constructeur
    ==========================*/
    public function __construct() {
        $this->setBdd('version1_alpha');
    }

    /*=======================================================================================================
        Enregistrement d'une nouvelle campagne dans la table indiquée avec les arguments fournis par $POST
    =========================================================================================================*/
    public function registerNewParametres($POST) {
        $sql="UPDATE parametres SET distanceInterBarrieres ='".$POST['distanceBarrieres']."', repertoireImages='".$POST['repertoireImages']."', ipServeur='".$POST['ipServeur']."', ipCam1='".$POST['ipCam1']."', ipCam2='".$POST['ipCam2']."', ipModuleAcquisition='".$POST['ipESP']."', WIFI_SSID='".$POST['wifi_SSID']."', WIFI_KEY='".$POST['wifi_KEY']." WHERE id=1";
        $req=$this->getBdd()->query($sql);
    }

    /*==========================================================
    Récupération de tous les Parametres
    ==========================================================*/
    public function getAllParametres()
    {
        $var=[];
        $var=$this->getAll("parametres","Parametres");
        return $var;
    }

}