<?php

    require_once("model/userList_model.php");
    require_once("model/categoryList_model.php")

    $usuarios = new userList();

    $matrizUsuarios = $usuarios->getUserList();

    $categorias = new categoryList();

    $matrizCategorias = $categorias->getCategoryList();

    require_once("view/web_view.php");

?>