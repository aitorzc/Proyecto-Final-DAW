<?php

    class Team_round extends dbObject{
        // Variables del usuario
        private $IdEquipo_fk;
        private $IdRonda_fk;
        
        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('equipo_ronda');
        }
        
        // Setters y getters
        function getIdEquipo_fk() {
            return $this->IdEquipo_fk;
        }

        function getIdRonda_fk() {
            return $this->IdRonda_fk;
        }

        function setIdEquipo_fk($IdEquipo_fk) {
            $this->IdEquipo_fk = $IdEquipo_fk;
        }

        function setIdRonda_fk($IdRonda_fk) {
            $this->IdRonda_fk = $IdRonda_fk;
        }

        public function save(){
            $values = array(
                'IdEquipo_fk'  => $this->getIdEquipo_fk(),
                'IdRonda_fk'   => $this->getIdRonda_fk()
            );
            return $this->insertRow($values);
        }
    }

?>