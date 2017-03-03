<?php

    class user_model{

        private $db;
        private $usuarios;

        public function __construct(){

            require_once("connect.php");

            $this->db = connect::connection();

            $this->usuarios = array();

        }

        public function getUsers(){

            $consulta = $this->db->query("SELECT * FROM usuario");

            while ($row = $consulta->fetch_row()) { 
                       
                array_push($this->usuarios, $row[0]);

            }

            return $this->usuarios;

        }

    }

?>