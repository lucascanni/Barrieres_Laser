<?php

class Campagne {
    //ici, en private, je définis tous les champs de la table Campagne qui sera créée en base de données
    private $idCampagne; //numéro d'identifiant campagne (int)
    private $nomCampagne;//nom de la campagne (varchar)
    private $dateCampagne; //date de la campagne (date)
    private $description; // description campagne (longtext)
    private $longitude; //longitude (varchar)
    private $latitude; // latitude (varchar)

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
    public function getIdCampagne() {
        return $this->idCampagne;
    }
    public function getNomCampagne() {
        return $this->nomCampagne;
    }
    public function getDateCampagne() {
        return $this->dateCampagne;
    }
    public function getDescription() {
        return $this->description;
    }
    public function getLongitude() {
        return $this->longitude;
    }
    public function getLatitude() {
        return $this->latitude;
    }

    //SETTERS
    public function setIdCampagne($idCampagne) {
        $idCampagne= (int) $idCampagne;
        if($idCampagne>0)
            $this->idCampagne = $idCampagne;
    }

    public function setNomCampagne($nomCampagne) {
        $nomCampagne = strval($nomCampagne);
        $this->nomCampagne=$nomCampagne;
    }

    public function setDateCampagne($dateCampagne) {
        $dateCampagne = strval($dateCampagne);
        $this->dateCampagne=$dateCampagne;
    }

    public function setDescription($description) {
        $description = strval($description);
        $this->description=$description;
    }

    public function setLongitude($longitude) {
        $longitude = strval($longitude);
        $this->longitude = $longitude;
    }

    public function setLatitude($latitude) {
        $latitude = strval($latitude);
        $this->latitude = $latitude;
    }

}
