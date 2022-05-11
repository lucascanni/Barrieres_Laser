<?php
class LaserManager extends Model
{
    /*======================================================
        Constructeur : définition de la base de données
     =======================================================*/
     public function __construct() {
        $this->setBdd('version1_alpha');//nom de la bdd
    }

    /*======================================================
        Récupération de toutes les températures
    =======================================================*/
    public function getAllLaser() {
        //ici, je simule les valeurs renvoyées par la base de données
        $var=[];

        // Cherchons les températures dans la base de données
        $var=$this->getAll("mesure" , "Barriere"); //nom de la table puis nom de la classe qui crée un objet de cette classe

        //var_dump($var);die();
        return $var;
    }

    /*==========================================================================
        Récupération de toutes les données à partir de l'ESP via la requête POST
    ============================================================================*/
    public function setNewValue($data) {
        //var_dump("Save values");
        //var_dump($data->value1);die();

        //Méthode1
        $val1="value1";
        //$val2="value2";
        //$sql = "INSERT INTO mesure (dateTime,".$val1.",".$val2.") VALUES (NOW(),".$data->value1.",".$data->value2.");";
        $sql = "INSERT INTO mesure (dateTime,".$val1.") VALUES (NOW(),".$data->value1.");";

        //Méthode 2
        //$sql = "INSERT INTO mesure (dateTime,value1 , value2) VALUES (NOW(),".$data->value1.",".$data->value2.");";

        //Méthode 3
        //$sql = "INSERT INTO mesure (dateTime, value1 , value2) VALUES (NOW(),";
        //$sql=$sql.$data->value1.",".$data->value2.");";

        $req=$this->getBdd()->prepare($sql);
        $req->execute();

        //fonction pour executer une reqête sql : mysql_query()
        return;
    }

    /*==========================================================================
        On cherche à trouver les données de la dernière acquiqition
    ============================================================================*/
    public function getLastSpeed() {

        $var=[];
        $obj="Barriere";

        //On cherche la dernière acquisition (la plus récente)
        $dateTime = "SELECT * FROM mesure where dateTime=(SELECT max(dateTime) FROM mesure);";

        //var_dump("Affichage de la dernière mesure");
        $req=$this->getBdd()->prepare($dateTime);
        $req->execute();

        while($data=$req->fetch(PDO::FETCH_ASSOC)) {
            //var_dump($data);die();
            $var[]=new $obj($data);
        }
        $req->closeCursor();
        return $var;

    }

    /*==============================================================================
        On cherche à trouver le dernier identifiant (pour le raspberry de grégory)
    ================================================================================*/
    public function getLastId() {

        $var=[];
        $obj="Barriere";

        //Requête pour trouver le dernier identifiant
        $id= "SELECT id FROM mesure WHERE id=(SELECT max(id) FROM mesure);";

        $req=$this->getBdd()->prepare($id);
        $req->execute();
        //var_dump("je suis dans laser manager");die();
        while($data=$req->fetch(PDO::FETCH_ASSOC)) {
            //var_dump($data);die();
            $var[]=new $obj($data);break;
        }
        $req->closeCursor();

        return $var;
    }

    /*==============================================================================
        On cherche à déterminer la vitesse d'un véhicule
    ================================================================================*/
    public function getVitesse() {

        $var=[];$tab=[];$tub=[];
        $obj="Barriere";

        //on cherche l'intervalle pour le calcul de la vitesse
        $intervalle= "SELECT value1 FROM mesure WHERE id=(SELECT max(id) FROM mesure);";
        $req=$this->getBdd()->prepare($intervalle);
        $req->execute();
        
        while($data=$req->fetch(PDO::FETCH_ASSOC)) {
            $var[]=new $obj($data);break;
        }
        $req->closeCursor();

        //On extrait la valeur du tableau
        extract($var); 

        //Valeur de l'intervalle
        $temps=$var[0]->getValue1();

        //On cherche maintenant à extraire la distance entre les barrières via la table paramètres 
        $classe="Parametres";
        $str= "SELECT distanceBarrieres FROM parametres;";
        $req=$this->getBdd()->prepare($str);
        $req->execute();
        
        while($tutu=$req->fetch(PDO::FETCH_ASSOC)) {
            $tub[]=new $classe($tutu);break;
        }
        
        $req->closeCursor();

        //On extrait la valeur du tableau
        extract($tub); 

        //Valeur de la distance
        $distance=$tub[0]->getDistanceBarrieres();

        //On calcule la vitesse
        $vitesse=($distance/$temps)*3600;
        //$vitesse=floatval(($distance/$temps)*3600);

        return $vitesse;

    }


    /*==============================================================================
        Mise à jour de la vitesse dans la table mesure
    ================================================================================*/
    public function laserUpdate($vitesse , $id) {

        //$val2="value2";
        $sql = "UPDATE mesure SET value2 =".$vitesse." WHERE id=".$id.";";

        $req=$this->getBdd()->prepare($sql);
        $req->execute();

        //fonction pour executer une reqête sql : mysql_query()
        return;

    }

    /*======================================================
        Récupération des températures d'un capteur précis
     =======================================================*/
     public function getLas($idCapteur) {
        $var=[];
        $var=$this->getPartial("mesure" , "Barriere", "id=".$idCapteur);
        return $var;
    }


}