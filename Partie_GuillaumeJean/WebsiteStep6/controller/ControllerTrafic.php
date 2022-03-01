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
                /* Pour envoyer les données de l'ESP
                if ($url[1]=="new")
                {
                    $this->traficManager=new TraficManager;
                    $this->traficManager->saveNewValue($_POST);
                }
                */

                if($url[1]=="last")
                {
                    $this->traficManager=new TraficManager;
                    $data=$this->traficManager->getVitesse($url[1]);
                    $lesDates=$this->TraficManager->getdate($url[1]);
                    $lesMesures=$this->TraficManager->getValues($url[1]);
                    require_once 'view/viewAllTrafic.php';

                }
                else
                {
                    
                    $this->traficManager=new TraficManager;
                    
                    $data=$this->traficManager->getVitesse($url[1]);
                    
                    $lesDates=$this->traficManager->getdate($url[1]);
                    //var_dump($lesDates);die();

                    $lesMesures=$this->traficManager->getValues($url[1]);

                    require_once 'view/viewAllTrafic.php';

                }
            }
            else
            {
                throw new Exception ("Erreur d'url");
            }
    }
}