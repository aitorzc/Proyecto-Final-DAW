<?php

    class Round extends dbObject{
        // Variables del usuario
        private $IdRonda;
        private $Ronda;
        private $IdGanador_fk;
        private $IdTorneo_fk;
        
        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('ronda');
        }
        
        // Setters y getters
        function getIdRonda() {
            return $this->IdRonda;
        }

        function getRonda() {
            return $this->Ronda;
        }

        function getIdTorneo_fk() {
            return $this->IdTorneo_fk;
        }

        function setIdRonda($IdRonda) {
            $this->IdRonda = $IdRonda;
        }

        function setRonda($Ronda) {
            $this->Ronda = $Ronda;
        }
        
        function getIdGanador_fk() {
            return $this->IdGanador_fk;
        }

        function setIdGanador_fk($IdGanador_fk) {
            $this->IdGanador_fk = $IdGanador_fk;
        }

        function setIdTorneo_fk($IdTorneo_fk) {
            $this->IdTorneo_fk = $IdTorneo_fk;
        }

        public function save(){
            $values = array(
                'IdTorneo_fk' => $this->getIdTorneo_fk(),
                'Ronda'    => $this->getRonda()
            );
            return $this->insertRow($values);
        }
    }

?>