<?php
    //TODO: acabar clase
    class post extends dbObject{

        private $id;
        private $nombre;
        private $descripcion;
        private $idCategoria;

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

        public function setDescripcion($descripcion){
            $this->descripcion = $descripcion;
        }
        public function getDescripcion(){
            return $this->descripcion;
        }

        public function setIdCategoria($idCategoria){
            $this->idCategoria = $idCategoria;
        }
        public function getIdCategoria(){
            return $this->idCategoria;
        }
    }

?>