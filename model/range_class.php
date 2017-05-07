<?php

    class Range extends dbObject{
        // Variables del usuario
        private $IdRango;
        private $Nombre;

        
        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('rango');
        }
        
        // Setters y getters
        function getIdRango() {
            return $this->IdRango;
        }

        function getNombre() {
            return $this->Nombre;
        }

        function setIdRango($IdRango) {
            $this->IdRango = $IdRango;
        }

        function setNombre($Nombre) {
            $this->Nombre = $Nombre;
        }

        public function save(array $values){
            return $this->insertRow($values);
        }
    }

?>