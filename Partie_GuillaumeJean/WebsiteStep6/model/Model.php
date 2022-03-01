<?php

class Model
{
    private $bdd;

    //      Définition de la base de données

    public function setBdd($dataBase,$host='localhost',$login='root',$password='')
    {
        $this->_bdd=new PDO('mysql:dbname='.$dataBase.';charset=utf8;host='.$host,$login,$password);
        $this->_bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
    }

    //      Récupération de la connexion à la base de données

    public function getBdd()
    {
        return $this->_bdd;
    }

    //      Récupération de tous les éléments d'une table et instanciation de la classe nommée $obj

    protected function getAll($table,$obj)
    {
        $var=[];
        $req=$this->getBdd()->prepare('SELECT * FROM '.$table.' ORDER BY id DESC');
            //$req=$this->getBdd()->prepare('SELECT * FROM '.$table.' WHERE id=(SELECT max(id) FROM '.$table.')');              Ligne permettant d'afficher la dernière valeur de la table
        $req->execute();
        while($data=$req->fetch(PDO::FETCH_ASSOC))
        {
            $var[]= new $obj($data);
        }
        $req->closeCursor();
        return $var;
    }

    // Récupération partielle d'un élément d'une table et instanciation de la classe nommé $obj

    protected function getPartial($table,$obj, $criteria)
    {
        $var=[];
        //$sql='SELECT * FROM '.$table.' WHERE id=(SELECT max(id) FROM '.$table.')';
        //var_dump($sql);die();
        $sql='SELECT * FROM '.$table.' WHERE '.$criteria;
        //var_dump($sql);die();       
        $req=$this->getBdd()->prepare($sql);
        $req->execute();

        while($data=$req->fetch(PDO::FETCH_ASSOC))
        {
            $var[]=new $obj($data);
        }

        $req->closeCursor();
        return $var;
    }
}