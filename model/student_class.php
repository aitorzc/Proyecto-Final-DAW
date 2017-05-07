<?php

    class Student extends dbObject{
        // Variables del usuario
        private $IdAlumno;
        private $Nombre;
        private $Apellido;
        private $Email;
        private $Usuario_fk;
        private $Curso_fk;
        private $Permiso;
        
        // Constructor
        public function __construct() {
            parent::__construct();
            $this->setTable('alumno');
        }
        
        // Setters y getters
        function getIdAlumno() {
            return $this->IdAlumno;
        }

        function getNombre() {
            return $this->Nombre;
        }

        function getApellido() {
            return $this->Apellido;
        }

        function getEmail() {
            return $this->Email;
        }

        function getUsuario_fk() {
            return $this->Usuario_fk;
        }

        function getCurso_fk() {
            return $this->Curso_fk;
        }

        function getPermiso() {
            return $this->Permiso;
        }

        function setIdAlumno($IdAlumno) {
            $this->IdAlumno = $IdAlumno;
        }

        function setNombre($Nombre) {
            $this->Nombre = $Nombre;
        }

        function setApellido($Apellido) {
            $this->Apellido = $Apellido;
        }

        function setEmail($Email) {
            $this->Email = $Email;
        }

        function setUsuario_fk($Usuario_fk) {
            $this->Usuario_fk = $Usuario_fk;
        }

        function setCurso_fk($Curso_fk) {
            $this->Curso_fk = $Curso_fk;
        }

        function setPermiso($Permiso) {
            $this->Permiso = $Permiso;
        }

        public function save(array $values){
            return $this->insertRow($values);
        }
    }

?>