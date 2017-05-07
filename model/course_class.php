<?php

    class Course extends dbObject{
        // Variables del usuario
        private $IdCurso;
        private $Nombre;
        
        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('curso');
        }
        
        // Setters y getters
        function getIdCurso() {
            return $this->IdCurso;
        }

        function getNombre() {
            return $this->Nombre;
        }

        function setIdCurso($IdCurso) {
            $this->IdCurso = $IdCurso;
        }

        function setNombre($Nombre) {
            $this->Nombre = $Nombre;
        }

                
        public function save(array $values){
            return $this->insertRow($values);
        }
    }

?>