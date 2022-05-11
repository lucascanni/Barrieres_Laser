<?php
class CampagneManager extends Model {

    /*=========================
        Constructeur
    ==========================*/
    public function __construct() {
        $this->setBdd('version1_alpha');
    }

    /*=======================================================================================================
        Enregistrement d'une nouvelle campagne dans la table indiquée avec les arguments fournis par $POST
    =========================================================================================================*/
    public function registerNewCampagne($POST) {  //."', Longitude='".$POST['longitude']."', Lattitude='".$POST['lattitude']
        $sql="INSERT INTO campagne SET nomCampagne='".$POST['nomCampagne']."', dateCampagne='".$POST['dateCampagne']."', Description='".$POST['description']."'";
        //var_dump($sql);die();
        $req=$this->getBdd()->query($sql);
    }


    /*==========================================================
    Récupération de tous les utilisateurs
    ==========================================================*/
    public function getAllCampagne()
    {
        $var=[];
        $var=$this->getAll("campagne","Campagne");
        return $var;
    }

    /*==========================================================
    Supression d'un utilisateur
    ==========================================================*/
    public function deleteCampagne($nomCampagne)
    {
        $sql="DELETE FROM campagne WHERE nomCampagne='".$nomCampagne."'";
        $this->getBdd()->query($sql);
    }


}