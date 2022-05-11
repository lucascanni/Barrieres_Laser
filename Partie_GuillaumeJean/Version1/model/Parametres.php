<?php

class Parametres 
{
    //ici, en private, je définis tous les champs de la table Paramètres qui sera créée en base de données
    private $id; //clé primaire (int)
    private $distanceInterBarrieres; // distance entre les deux barrières (float)
    private $repertoireImages; //chemin du répertoire de l'image (varchar)
    private $ipServeur; //adresse  IP du serveur (varchar)
    private $ipCam1; //adresse IP de la caméra 1 (varchar)
    private $ipCam2; //adresse IP de la caméra 2 (varchar)
    private $ipModuleAcquisition; //adresse IP du module d'acquisition (varchar)
    private $wifi_SSID; //SSID du module wifi (varchar)
    private $wifi_KEY; //clé du point d'accès wifi (varchar)
    private $niveauBatterie; //niveau de la batterie (int)

    //CONSTRUCTEUR
    public function __construct(array $data) {
        $this->hydrate($data); //permet d'appeler les setters correspondant
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' .ucfirst($key);
            if(method_exists($this,$method))
                $this->$method($value);
        }
    }

    //GETTERS
    public function getIdParam() {
        return $this->id;
    }
    public function getDistanceBarrieres() {
        return $this->distanceInterBarrieres;
    }
    public function getRepertoireImages() {
        return $this->repertoireImages;
    }
    public function getipServeur() {
        return $this->ipServeur;
    }
    public function getipCam1() {
        return $this->ipCam1;
    }
    public function getipCam2() {
        return $this->ipCam2;
    }
    public function getipESP() {
        return $this->ipModuleAcquisition;
    }
    public function getWifi_SSID() {
        return $this->wifi_SSID;
    }
    public function getWifi_KEY() {
        return $this->wifi_KEY;
    }
    public function getNiveauBatterie() {
        return $this->niveauBatterie;
    }


    //SETTERS
    public function setIdParam($id) {
        $id = (int) $id;
        if($id>0)
            $this->id = $id;
    }

    public function setdistanceInterBarrieres($distanceInterBarrieres) {
        $distanceInterBarrieres = floatval($distanceInterBarrieres);
        if($distanceInterBarrieres>0.0)
            $this->distanceInterBarrieres = $distanceInterBarrieres;
    }

    public function setRepertoireImages($repertoireImages) {
        $repertoireImages = strval($repertoireImages);
        $this->repertoireImages = $repertoireImages;
    }

    public function setipServeur($ipServeur) {
        $ipServeur = strval($ipServeur);
        $this->ipServeur = $ipServeur;
    }

    public function setipCam1($ipCam1) {
        $ipCam1 = strval($ipCam1);
        $this->ipCam1 = $ipCam1;
    }

    public function setipCam2($ipCam2) {
        $ipCam2 = strval($ipCam2);
        $this->ipCam2 = $ipCam2;
    }

    public function setipModuleAcquisition($ipModuleAcquisition) {
        $ipModuleAcquisition = strval($ipModuleAcquisition);
        $this->ipModuleAcquisition = $ipModuleAcquisition;
    }

    public function setWifi_SSID($wifi_SSID) {
        $wifi_SSID = strval($wifi_SSID);
        $this->wifi_SSID = $wifi_SSID;
    }

    public function setWifi_KEY($wifi_KEY) {
        $wifi_KEY = strval($wifi_KEY);
        $this->wifi_KEY = $wifi_KEY;
    }

    public function setNiveauBatterie($niveauBatterie) {
        $niveauBatterie = (int) $niveauBatterie;
        if($niveauBatterie>=0)
            $this->niveauBatterie = $niveauBatterie;
    }

}
