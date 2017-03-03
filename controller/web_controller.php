<?php

    require_once("model/user_model.php");

    $usuarios = new user_model();

    $matrizUsuarios = $usuarios->getUsers();

    require_once("view/web_view.php");

?>