<?php

    class Connect{

        public static function connection(){

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

    }

?>