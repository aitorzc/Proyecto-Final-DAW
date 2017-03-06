<?php

    class categoryList{

        private $db;

        private $categoryList;
        // Constructor
        public function __construct(){

            require_once("model/connect.php");

            $this->db = Connection::connect();

            $this->categoryList = array();

            require_once("model/category_class.php");

        }
        //Recoger las categorías
        public function getCategoryList(){

            $consulta = $this->db->query("SELECT * FROM categorias");

            while($row = $consulta->fetch_row()){

                $category = new category();

                $category->setId($row[0]);

                $category->setNombre($row[1]);

                array_push($this->categoryList, $category);

            }
            // Fin de la conexión
            Connection::disconnect();
            
            return $this->categoryList;

        }

    }

?>