<?php

    class user{
        // Variables del usuario
        private $login;
        private $pswd;
        private $email;
        private $nombre;
        private $DNI;
        private $img;
        private $rango; 
        // Constructor
        public function __construct(){
        }
        // Setters y getters
        public function setLogin($login){
            $this->login = $login;
        }
        public function getLogin(){
            return $this->login;
        }

        public function setPswd($pswd){
            $this->pswd = $pswd;
        }
        public function getPswd(){
            return $this->pswd;
        }

        public function setEmail($email){
            $this->email = $email;
        }
        public function getEmail(){
            return $this->email;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function getNombre(){
            return $this->nombre;
        }

        public function setDNI($DNI){
            $this->DNI = $DNI;
        }
        public function getDNI(){
            return $this->DNI;
        }

        public function setImg($img){
            $this->img = $img;
        }
        public function getImg(){
            return $this->img;
        }

        public function setRango($rango){
            $this->rango = $rango;
        }
        public function getRango(){
            return $this->rango;
        }

    }

?>