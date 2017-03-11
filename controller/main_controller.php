<?php

    require_once("model/categoryList_model.php");

    //Recogemos lista de categorías
    $categorias = new categoryList();

    $matrizCategorias = $categorias->getCategoryList();

    require_once("view/main/prototype_web.php");


?>