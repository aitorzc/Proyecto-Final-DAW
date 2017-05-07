<?php

    class Team extends dbObject{
        // Variables del usuario
        private $IdEquipo;
        private $Nombre;
        private $IdTorneo_fk;
        
        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('equipo');
        }
        
        // Setters y getters
        function getIdEquipo() {
            return $this->IdEquipo;
        }

        function getNombre() {
            return $this->Nombre;
        }

        function getIdTorneo_fk() {
            return $this->IdTorneo_fk;
        }

        function setIdEquipo($IdEquipo) {
            $this->IdEquipo = $IdEquipo;
        }

        function setNombre($Nombre) {
            $this->Nombre = $Nombre;
        }

        function setIdTorneo_fk($IdTorneo_fk) {
            $this->IdTorneo_fk = $IdTorneo_fk;
        }

        
        public function save(array $values){
            return $this->insertRow($values);
        }
    }

?>