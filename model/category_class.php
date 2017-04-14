<?php

    class Category extends dbObject{
        
        private $id;
        private $nombre;

        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('categoria');
        }

        //Getters y setters
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

    }

?>