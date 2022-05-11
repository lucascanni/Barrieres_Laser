<?php
/*=================================================
Classe qui gère les validations des saisies
===================================================*/
class Validator {
    private $data;
    private $errors;

    /*=================================================
        Constructeur
    ===================================================*/
    public function __construct($data) {
        $this->data=$data;
    }

    /*=================================================
        Récupération d'un champ donné
    ===================================================*/
    public function getField($field) {
        if (!isset($this->data[$field])) {
            return null;
        }
        return $this->data[$field];
    }

    /*==========================================================================================
        Renvoie true si les caractères saisis sont des lettres, chiffres ou symbole underscore
    =============================================================================================*/
    public function isAlpha($field, $errorMsg="Seuls les caractères alphanumériques et le underscore sont valides") {
        //var_dump($this->getField($field));die();
        if (!preg_match('/^[a-zA-Z0-9_]+$/',$this->getField($field))) {
            //var_dump($field);die();
            $this->errors=$errorMsg;
            return false;
        }
        return true;
    }

    /*==========================================================================================
        Renvoie true si la valeur saisie n'existe pas déjà en base de données
    =============================================================================================*/
    public function isUnique($field, $db, $table, $errorMsg="Le champ n'est pas unique") {
       $sql="SELECT id FROM $table WHERE $field =". '"'.$this->getField($field).'"';
       $record=$db->query($sql)->fetch();
        //var_dump($sql);die();
       if ($record) {
           $this->errors=$errorMsg;
           return false;
       }
       return true;
    }

    /*==========================================================================================
        Renvoie true si le champ de confirmation contient la même chose que le champ saisi
    =============================================================================================*/
    public function isConfirmed($field, $errorMsg="Erreur de confirmation") {
 
        if (empty($this->getField($field)) || $this->getField($field) != $this->getField($field.'_confirm')) {
            $this->errors=$errorMsg;
            return false;
        }
        return true;
     }

    /*==========================================================================================
        Renvoi des erreurs éventuelles
    =============================================================================================*/
    public function getErrors() {
 
        return $this->errors;
     }

} 