<?php
class ControllerTrafic
{
    public function __construct($url)
    {
            if($url=='')
                throw new Exception('Page introuvable');
                //Si juste 1 argument, on récupère toutes le trafic
            else if(isset($url) && count ($url)==1)
            {
                $this->traficManager=new TraficManager;
                $data=$this->traficManager->getAllTrafic();
                $title = 'Vitesses mesurées :';
                require_once 'view/viewAllTrafic.php';
            }
            else if (isset($url) && count($url)==2)
            {
                
                $this->traficManager=new TraficManager;
                $data=$this->traficManager->getVitesse($url[1]);
                require_once 'view/viewAllTrafic.php';
            }
            else
            {
                throw new Exception ("Erreur d'url");
            }
    }
}