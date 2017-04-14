<?php

    class Sport extends dbObject{

        private $id;
        private $nombre;
        private $descripcion;
        
        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('deporte');
        }
        
        // Setters y getters
        public function setId($id){
            $this->id = $id;
        }
        public function getId(){
            return $this->id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function getNombre(){
            return $this->nombre;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }
        
    }

?>