<?php

class ControllerAccueil
{
    public function __construct($url=null)
    {
        var_dump("ControllerAccueil");
        require_once "view/viewAccueil.php";
        
    }
}