<?php

    class user{
        // Variables del usuario
        private $login;
        private $pswd;
        private $email;
        private $nombre;
        private $firma;
        private $img;
        private $tipo; 
        // Constructor
        public function __construct(){

            require_once("model/connect.php");

            $this->db = Connection::connect();

            $this->userList = array();

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

        public function setFirma($firma){
            $this->firma = $firma;
        }
        public function getFirma(){
            return $this->firma;
        }

        public function setImg(){
            $this->img = $img;
        }
        public function getImg(){
            return $this->img;
        }

        public function setTipo(){
            $this->tipo = tipo;
        }
        public function getTipo(){
            return $this->tipo;
        }

    }

?>