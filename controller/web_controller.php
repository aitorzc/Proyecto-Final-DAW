<?php

    require_once("model/userList_model.php");

    $usuarios = new userList();

    $matrizUsuarios = $usuarios->getUserList();

    require_once("view/web_view.php");

?>