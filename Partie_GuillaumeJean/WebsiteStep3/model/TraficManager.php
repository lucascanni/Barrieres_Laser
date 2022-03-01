<?php
class TraficManager extends Model
{

    // Constructeur

    public function __construct()
    {
        $this->setBdd('db_test');
    }

    //  Récupération de toutes les températures

    public function getAllTrafic()
    {
        //Simulation des vitesses

        $var=[];
        $var=$this->getAll("vitesse", "Vitesse");
        return $var;
    }
}