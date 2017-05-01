<?php

    class Category extends dbObject{
        
        private $nombre;
        private $descripcion;

        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('sistema_deportes');
        }

        //Getters y setters
        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function getNombre(){
            return $this->id;
        }

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }

    }

?>