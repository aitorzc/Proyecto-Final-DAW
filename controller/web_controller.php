<?php

    require_once("model/userList_model.php");
    require_once("model/categoryList_model.php");
    require_once("model/postList_model.php");
    // Recogemos lista de usuarios
    $usuarios = new userList();

    $matrizUsuarios = $usuarios->getUserList();

    //Recogemos lista de categorías
    $categorias = new categoryList();

    $matrizCategorias = $categorias->getCategoryList();

    //Recogemos lista de posts
    $posts = new postList();

    $matrizPosts = $posts->getPostList();

    require_once("view/web_view.php");

?>