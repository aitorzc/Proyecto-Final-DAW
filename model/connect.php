<?php

    class Connection{
        // Conexión al servidor o en caso de error recoger el mensaje
        public static function connect(){

            try{

                $con = mysqli_connect("localhost", "root", "", "vidstofind");

                $con->set_charset("UTF-8");

                if ($con->connect_errno) {

                    echo "Conexión fallida:" . $con->connect_error;

                    exit();

                }

            }catch(Exception $e){

                die("Error" . $e->getMessage());

                echo "Línea del error". $e->getLine();

            }

            return $con;
        }
        // Desconexión del servidor
        public static function disconnect(){

            $con = mysqli_connect("localhost", "root", "", "vidstofind");

           $con->close();

        }        

    }

?>