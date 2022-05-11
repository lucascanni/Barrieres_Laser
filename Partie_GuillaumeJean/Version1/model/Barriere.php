<?php

class Barriere {
    //ici, en private, je définis tous les champs de la table Temperature qui sera créée en base de données
    private $id; //clé primaire
    private $dateTime; // date et heure d'acquisition
    private $value1; //valeur de la première valeur
    private $value2; // Valeur de la deuxième valeur

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
    public function getId() {
        return $this->id;
    }
    public function getDateTime() {
        return $this->dateTime;
    }
    public function getValue1() {
        return $this->value1;
    }
    public function getValue2() {
        return $this->value2;
    }

    //SETTERS
    public function setId($id) {
        $id = (int) $id;
        if($id>0)
            $this->id = $id;
    }

    public function setDateTime($dateTime) {
        $this->dateTime=$dateTime;
    }

    public function setValue1($value1) {
        $value1 = (int) $value1;
        if($value1>0)
            $this->value1 = $value1;
    }

    public function setValue2($value2) {
        $value2= floatval($value2);
        if($value2>0)
            $this->value2=$value2;
    }

}
