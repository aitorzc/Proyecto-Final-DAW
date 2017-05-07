<?php

    class Category extends dbObject{
        
        private $IdSistema;
        private $Nombre;
        private $Descripcion;

        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('sistema');
        }

        //Getters y setters
        function getIdSistema() {
            return $this->IdSistema;
        }

        function getNombre() {
            return $this->Nombre;
        }

        function getDescripcion() {
            return $this->Descripcion;
        }

        function setIdSistema($IdSistema) {
            $this->IdSistema = $IdSistema;
        }

        function setNombre($Nombre) {
            $this->Nombre = $Nombre;
        }

        function setDescripcion($Descripcion) {
            $this->Descripcion = $Descripcion;
        }

        public function save(array $values){
            return $this->insertRow($values);
        }

    }

?>