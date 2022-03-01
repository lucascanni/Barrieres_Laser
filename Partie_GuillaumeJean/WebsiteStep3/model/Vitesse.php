<?php

class Vitesse
{
    //Ici, en private on définis tous les champs
    // de la table Vitesse qui sera créée en base de données
    private $id;        //  clé primaire
    private $idVehicule; //  identifiant du véhicule
    private $dateTime;  //  date et heure d'aquisition
    private $value;     //  valeur de la vitesse



    //Constructeur
    public function __construct(array $data)
    {
        //var_dump($data);die;
        $this->hydrate($data);
    }

    public function hydrate(array $data)
    {
        foreach ($data as $key =>$value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this,$method))
                $this->$method($value);
        }
    }
    //GETTERS
    public function getId()
    {
        return $this->id;
    }

    public function getIdVehicule()
    {
        return $this->idVehicule;
    }

    public function getDateTime()
    {
        return $this->dateTime;
    }

    public function getValue()
    {
        return $this->value;
    }

    //SETTERS
    public function setId($id)
    {
        $id = (int)$id;
        if($id>0)
            $this->id=$id;

    }

    public function setIdVehicule($idVehicule)
    {
        $idVehicule = (int)$idVehicule;
        if($idVehicule>0)
            $this->idVehicule=$idVehicule;
    }

    public function setDateTime($dateTime)
    {
        $this->dateTime=$dateTime;
    }

    public function setValue($value)
    {
        $this->value=$value;
    }




}   