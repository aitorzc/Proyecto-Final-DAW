<?php

    class userList{

        private $db;

        private $userList;

        public function __construct(){

            require_once("model/connect.php");

            $this->db = Connection::connectDB;

            $userList = array();

            require_once("controller/user_controller.php");

        }
        // Recogida de usuarios de la base de datos
        public function getUserList(){

            $consulta = $db->query("SELECT * FROM usuario");

            while ($row = $consulta->fetch_row()) {

                $usuario = new user();

                $usuario->setLogin($row[0]);

                $usuario->setPswd($row[1]);

                $usuario->setEmail($row[2]);

                $usuario->setNombre($row[3]);

                $usuario->setFirma($row[4]);

                $usuario->setImg($row[5]);

                $usuario->setTipo($row[6]);

                array_push($userList, $usuario);

            }
            // Fin de conexión
            Connection::disconnect;

            return $userList;

        }

    }

?>