<?php

    class User extends dbObject{
        // Variables del usuario
        private $login;
        private $pswd;
        private $email;
        private $nombre;
        private $apellido;
        private $curso;
        private $img;
        private $rango; 
        private $permiso;
        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('user');
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
        
        function getApellido() {
            return $this->apellido;
        }
        function setApellido($apellido) {
            $this->apellido = $apellido;
        }

        public function setCurso($curso){
            $this->curso = $curso;
        }
        public function getCurso(){
            return $this->curso;
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
        
        function getPermiso() {
            return $this->permiso;
        }
        function setPermiso($permiso) {
            $this->permiso = $permiso;
        }

        public function save(array $values){
            return $this->insertRow($values);
        }
    }

?>