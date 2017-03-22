<?php

    require_once("model/sportList_model.php");

    //Recogemos lista de categorías
    $deportes = new sportList();

    $matrizDeportes = $deportes->getSportList();

    require_once("view/main/prototype_web.php");


?>