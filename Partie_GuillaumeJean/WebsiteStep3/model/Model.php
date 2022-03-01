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
        $req=$this->getBdd()->prepare('SELECT * FROM '.$table.' ORDER BY id asc');
        $req->execute();
        while($data=$req->fetch(PDO::FETCH_ASSOC))
        {
            $var[]= new $obj($data);
        }
        $req->closeCursor();
        return $var;
    }
}