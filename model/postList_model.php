<?php

    class postList{
        //Conexión al servidor
        private $db;
        // Array de posts
        private $postList;
        // Constructor
        public function __construct(){

            require_once("model/connect.php");

            $this->db = Connection::connect();

            $this->postList = array();

            require_once("model/post_class.php");

        }
        // Recoger los posts y meterlos en $postList
        public function getPostList(){

            $consulta = $this->db->query("SELECT * FROM posts");

            while ($row = $consulta->fetch_row()) {

                $post = new post();

                $post->setId($row[0]);

                $post->setNombre($row[1]);
                
                $post->setDescripcion($row[2]);

                $post->setIdCategoria($row[3]);

                array_push($this->postList, $post); 

            }
            // Fin de la conexión
            Connection::disconnect();

            return $this->postList;

        }

    }

?>