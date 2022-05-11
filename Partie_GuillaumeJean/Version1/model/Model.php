<?php
class Model {
    //GESTION DE LA BASE DE DONNEES
    private $bdd; //base de données

    /*===================================
     Définition de la base de données
    =====================================*/
    public function setBdd($database,$host='localhost',$login='root',$password='') { //Changer les valeurs pour passer sur raspberry
        $this->_bdd=new PDO('mysql:dbname='.$database.';charset=utf8;host='.$host,$login,$password);
        $this->_bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }

    /*======================================================
        Récupération de la connexion à la base de données
     =======================================================*/
    public function getBdd() {
         return $this->_bdd;
    }

    /*======================================================
        Récupération de la connexion à la base de données
     =======================================================*/
    protected function getAll($table,$obj) {
        $var=[];
        $req=$this->getBdd()->prepare('SELECT * FROM '.$table.' ORDER BY id desc');
        //var_dump($obj);die();
        $req->execute();
        while($data=$req->fetch(PDO::FETCH_ASSOC)) {
            $var[]=new $obj($data);                               //obj = 7 cases      data = 10 cases
        }
        $req->closeCursor();
        return $var;
    }

    /*===========================================================================================
        Récupération partielle d'éléments d'une table et istanciation de la classe nommée $obj
     ==============================================================================================*/
     protected function getPartial($table,$obj, $criteria) {
        $var=[];
        $sql='SELECT * FROM '.$table.' WHERE '.$criteria;

        $req=$this->getBdd()->prepare($sql);
        $req->execute();

        while($data=$req->fetch(PDO::FETCH_ASSOC)) {
            $var[]=new $obj($data);
        }
        $req->closeCursor();
        return $var;
    }
}