<?php

    class sportList{

        private $db;

        private $sportList;

        public function __construct(){

            require_once("model/connect.php");

            $this->db = Connection::connect();

            $this->sportList = array();

            require_once("model/sport_class.php");

        }

        public function getSportList(){
            // Recoger los posts y meterlos en $sports
            $consulta = $this->db->query("SELECT * FROM deportes");

            while ($row = $consulta->fetch_row()) {

                $sports = new sport();

                $sports->setId($row[0]);

                $sports->setNombre($row[1]);

                $sports->setDescripcion($row[2]);

                array_push($this->sportList, $sports);

            }  
            // Fin de la conexión
            Connection::disconnect();  

            return $this->sportList;

        }
    }

?>