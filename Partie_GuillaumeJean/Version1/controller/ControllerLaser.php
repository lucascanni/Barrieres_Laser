<?php
class ControllerLaser {
    public function __construct($url)
    {
        if($url=='')
            throw new Exception('Page introuvable');
        
        //si juste 1 argument, on récupère toutes les températures
        else if (isset($url) && count($url)==1) {
            $this->LaserManager=new LaserManager;
            $data=$this->LaserManager->getAllLaser();
            $title="Mesures Laser";
            require_once 'view/viewAllLaser.php';
        }

       
        //si 2 arguments et mot magique, on récupère les données envoyées par l'ESP32
        else if (isset($url) && count($url)==2) {

            //Pour que Lucas puisse m'enoyer des données
            if($url[1]=="new"){
                //Pour envoyer les données de l'ESP
                //Test de la requête POST
                $json=file_get_contents('php://input');

                //decode the json data
                $data=json_decode($json); 

                $this->LaserManager=new LaserManager;
                $this->LaserManager->setNewValue($data);

                //On va chercher le dernier identifiant 
                $id=$this->LaserManager->getLastId();
                //Calcul de la vitesse
                $vitesse=$this->LaserManager->getVitesse();

                //on met à jour la table
                $this->LaserManager->laserUpdate($vitesse , $id[0]->getId());

                return;
            }

            // si on veut la dernière acquisition
            if($url[1]=="last") {
                $this->LaserManager=new LaserManager;
                $data=$this->LaserManager->getLastSpeed();
                //var_dump($data);//affichage temporaire
                require_once 'view/viewAllLaser.php';
                return;
            }

            //si on veut le dernier identifiant de mesure
            if($url[1]=="id") {
                $this->LaserManager=new LaserManager;
                $data=$this->LaserManager->getLastId();
                $idPlusun=$data[0]->getId()+1;
                //echo $data[0]->getId();
                echo $idPlusun;
                return;
            }

            //si on veut connaitre la vitesse du véhicule
            if($url[1]=="vitesse") {
                $this->LaserManager=new LaserManager;
                $data=$this->LaserManager->getVitesse();
                //var_dump($data);//affichage temporaire

                return;
            }

            if(is_numeric($url[1])==true)
            {
                $this->LaserManager=new LaserManager;

                $data=$this->LaserManager->getLas($url[1]); // Fonction a coder
                //var_dump($data);//affichage temporaire
                require_once 'view/viewAllLaser.php';
                return; 
            }


            return;

        }
        else {
            throw new Exception("Erreur d'URL");
        }


    }
}