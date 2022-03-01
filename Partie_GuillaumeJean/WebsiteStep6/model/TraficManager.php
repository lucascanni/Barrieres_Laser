<?php
class TraficManager extends Model
{

    // Constructeur

    public function __construct()
    {
        $this->setBdd('db_test');
    }

    //  Récupération de toutes les Données

    public function getAllTrafic()
    {
        //Simulation des vitesses

        $var=[];
        $var=$this->getAll("vitesse", "value");
        return $var;
    }





    // Récupération d'une vitesse précise


    public function getVitesse($idVehicule)
    {
        if($idVehicule=="last")
        {
            $var=[];
            $var=$this->getPartial("vitesse","Vitesse","dateTime=(SELECT MAX(dateTime) from vitesse);");

            //SELECT * FROM vitesse WHERE dateTime=(SELECT MAX(dateTime) from vitesse);
        }
        else
        {
            $var=[];
            $var=$this->getPartial("vitesse","Vitesse","idVehicule=".$idVehicule);
            return $var;
        }
    }

    // Récupération de toules les valeurs associées a un véhicule précis

    public function getValues($idVehicule)
    {
        $var=[];

        $sql="SELECT value from vitesse WHERE idVehicule=".$idVehicule." ORDER BY datetime";
        $req=$this->getBdd()->prepare($sql);
        $req->execute();
        while($data=$req->fetch(PDO::FETCH_NUM))
        {
            $var[]=$data[0];
        }
        return $var;
    }






    public function getDate($idVehicule)
    {
        if($idVehicule=="last")
        {
            $var=[];        
            $formatDate_us="Y-m-d H:i:s";
            $formatDate_fr="d/m/Y H:i:s";
    
            $sql="SELECT dateTime from vitesse WHERE dateTime=(SELECT MAX(dateTime) from vitesse)";
            $req=$this->getBdd()->prepare($sql);
            $req->execute();
    
            while($data=$req->fetch(PDO::FETCH_NUM))
            {
                $date = DateTime::createFromFormat($formatDate_us,$data[0]);
    
                $var[]=$date->format($formatDate_fr);
            }
    
            return $var;

        }
        else
        {
            $var=[];        
            $formatDate_us="Y-m-d H:i:s";
            $formatDate_fr="d/m/Y H:i:s";
    
            
            $sql="SELECT dateTime from vitesse WHERE idVehicule=".$idVehicule." ORDER BY dateTime";
            $req=$this->getBdd()->prepare($sql);
            $req->execute();
    
            while($data=$req->fetch(PDO::FETCH_NUM))
            {
                $date = DateTime::createFromFormat($formatDate_us,$data[0]);
    
                $var[]=$date->format($formatDate_fr);
            }
            return $var;

        }
    }

}