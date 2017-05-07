<?php

    class Team_student extends dbObject{
        // Variables del usuario
        private $IdEquipo_fk;
        private $IdAlumno_fk;
        
        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('equipo_alumno');
        }
        
        // Setters y getters
        function getIdEquipo_fk() {
            return $this->IdEquipo_fk;
        }

        function getIdAlumno_fk() {
            return $this->IdAlumno_fk;
        }

        function setIdEquipo_fk($IdEquipo_fk) {
            $this->IdEquipo_fk = $IdEquipo_fk;
        }

        function setIdAlumno_fk($IdAlumno_fk) {
            $this->IdAlumno_fk = $IdAlumno_fk;
        }

        
        public function save(array $values){
            return $this->insertRow($values);
        }
    }

?>