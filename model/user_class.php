<?php

    class User extends dbObject{
        // Variables del usuario
        private $Login;
        private $Password;
        private $Avatar;
        private $Rango_fk; 
        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('usuario');
        }
        
        // Setters y getters
        function getLogin() {
            return $this->Login;
        }

        function getPassword() {
            return $this->Password;
        }

        function getAvatar() {
            return $this->Avatar;
        }

        function getRango_fk() {
            return $this->Rango_fk;
        }

        function setLogin($Login) {
            $this->Login = $Login;
        }

        function setPassword($Password) {
            $this->Password = $Password;
        }

        function setAvatar($Avatar) {
            $this->Avatar = $Avatar;
        }

        function setRango_fk($Rango_fk) {
            $this->Rango_fk = $Rango_fk;
        }

        public function save(array $values){
            return $this->insertRow($values);
        }
    }

?>