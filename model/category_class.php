<?php

    class category{
        // Variables de la categoria
        private $id;
        private $nombre;

        // Constructor
        public function __construct(){

           $this->id = null;

        }

        //Getters y setters
        public function getId(){
            return $this->id;
        }

        public function setNombre($nombre){
            $this->nombre = $nombre;
        }
        public function getNombre(){
            return $this->nombre;
        }

    }

?>