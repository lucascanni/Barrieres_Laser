<?php
class TraficManager
{
    public function getAllTrafic()
    {
        //Simulation des vitesses

        $var=[];

        $speed= array (  array( "id"=>"1",
                                "idVehicule"=>1,
                                "datetime"=>"2020-07-15 19:16:45",
                                "value"=>100),

                        array( "id"=>"2",
                                "idVehicule"=>2,
                                "datetime"=>"2020-07-27 10:45:25",
                                "value"=>50),
                                
                        array( "id"=>"2",
                                "idVehicule"=>3,
                                "datetime"=>"2020-06-20 15:20:10",
                                "value"=>200),      
                                
                        );
        
        foreach($speed as $laVitesse):
            
            $var[]=new Vitesse($laVitesse);
        endforeach ;
        return $var;
    }
}