<?php

class User {
    //ici, en private, je définis tous les champs de la table Utilisateur qui sera créée en base de données
    private $idUtilisateur; //numéro d'identifiant utilisateur (int)
    private $login; // login (varchar)
    private $password; //mot de passe (varchar)
    private $email; // email (varchar)
    private $privileges; //niveau de privilèges (int)

    //CONSTRUCTEUR
    public function __construct(array $data) {
        $this->hydrate($data); //permet d'appeler les setters correspondant
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' .ucfirst($key);
            if(method_exists($this,$method))
                $this->$method($value);
        }
    }

    //GETTERS
    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }
    public function getLogin() {
        return $this->login;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getEmail() {
        return $this->email;
    }
    public function getPrivileges() {
        return $this->privileges;
    }

    //SETTERS
    public function setIdUtilisateur($idUtilisateur) {
        $idUtilisateur = (int) $idUtilisateur;
        if($idUtilisateur>0)
            $this->idUtilisateur = $idUtilisateur;
    }

    public function setLogin($login) {
        //$login = strval($login);
        $this->login=$login;
    }

    public function setPassword($password) {
        //$password = strval($password);
        $this->password = $password;
    }

    public function setEmail($email) {
        $email = strval($email);
        $this->email = $email;
    }

    public function setPrivileges($privileges) {
        $privileges = (int) $privileges;
        if($privileges>=0)
            $this->privileges = $privileges;
    }

}
