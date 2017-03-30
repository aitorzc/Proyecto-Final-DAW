<?php

    class userList{

        private $db;

        private $userList;

        public function __construct(){

            require_once("model/connect.php");

            $this->db = Connection::connect();

            $this->userList = array();

            require_once("model/user_class.php");

        }
        // Recogida de usuarios de la base de datos
        public function getUserList(){

            $consulta = $this->db->query("SELECT * FROM usuarios");

            while ($row = $consulta->fetch_row()) {

                $usuario = new user();

                $usuario->setLogin($row[0]);

                $usuario->setPswd($row[1]);

                $usuario->setEmail($row[2]);

                $usuario->setNombre($row[3]);

                $usuario->setDNI($row[4]);

                $usuario->setImg($row[5]);

                $usuario->setRango($row[6]);

                 array_push($this->userList, $usuario);

            }
            // Fin de conexión
            Connection::disconnect();

            return $this->userList;

        }

        public function findUser($user){

            $pre = "SELECT * FROM usuarios WHERE Login = '".$user."'";
            $consulta = $this->db->query($pre);
            $userLog = new user();
            while ($row = $consulta->fetch_row()) {

                $userLog->setLogin($row[0]);

                $userLog->setPswd($row[1]);

                $userLog->setEmail($row[2]);

                $userLog->setNombre($row[3]);

                $userLog->setDNI($row[4]);

                $userLog->setImg($row[5]);

                $userLog->setRango($row[6]);
                
            }

            return $userLog;

        }

    }

?>