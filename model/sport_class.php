<?php

    class Sport extends dbObject{

        private $IdDeporte;
        private $Nombre;
        private $Descripcion;
        
        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('deporte');
        }
        
        // Setters y getters
        public function setId($IdDeporte){
            $this->IdDeporte = $IdDeporte;
        }
        public function getId(){
            return $this->IdDeporte;
        }

        function getNombre() {
            return $this->Nombre;
        }

        function getDescripcion() {
            return $this->Descripcion;
        }

        function setNombre($Nombre) {
            $this->Nombre = $Nombre;
        }

        function setDescripcion($Descripcion) {
            $this->Descripcion = $Descripcion;
        }
        
        public function save(){
            $values = array(
                'Nombre'        => $this->getNombre(),
                'Descripcion'   => $this->getDescripcion()
            );
            return $this->insertRow($values);
        }
    }
