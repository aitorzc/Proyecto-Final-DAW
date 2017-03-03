<?php

    class Connect{

        public static function conection(){

            try{

                $conection = new mysqli_connect("localhost", "root", "", "vidstofind");

                $connection->set_charset("UTF-8");

                if ($conection->connect_errno) {
                    echo "Conexión fallida:" . $conection->connect_error;
                    exit();
                }

            }catch(Exception $e){

                die("Error" . $e->getMessage());

                echo "Línea del error". $e->getLine():

            }
            return $connection;
        }        

    }

?>