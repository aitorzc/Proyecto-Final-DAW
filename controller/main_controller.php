<?php

    require_once("model/userList_model.php");

    //Recogemos lista de categorías
    $usuarios = new userList();

    $matrizUsuarios = $usuarios->getUserList();

    require_once("view/main/prototype_web.php");


?>