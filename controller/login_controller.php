<?php

    include_once("../model/userList_model.php");
    include_once("../model/user_class.php");

    include_once("../view/register/");

    $userList = new userList();

    $allUsers = $userList->getUserList();

    $message = "";


// Peticion de login
    if (isset($_POST['sendLog'])) {

       checklogin();

    }

    function checkLogin(){

         foreach ($allUsers as $user) {

            $userLogin = $user->getLogin();
            $userPswd = $user->getPswd();

// Si encuentra coincidencia en el nick comprueba que la contraseña sea la correcta
            if ($userLogin == $_POST['nickLog']) {

                if ($userPswd == $_POST['pswdLog']) {

                    $userLogged = $user;
                    $message.= "Bienvenido " . $user->getNombre();

                    return loginAccess($userLogged);

                }else{

                   return $message.= "Contraseña incorrecta";

                }

            }else{

                 return $message.= "Login o contraseña incorrecto";

            }  
        }
    }

    function loginAccess($user){

         session_start();

         $_SESSION['user'] = $user;

         if (checkUserRange() == 2) {

            header("Location: 127.0.0.1/dashboard/proyecto/view/manegement/");

         }else{

            header("Location: 127.0.0.1/dashboard/proyecto");

         }
         
    }

    function checkUserRange () {

        if(isset($_SESSION['user'])){

            if ($_SESSION['user']->getRango() == 1) {

                return 1;

            }else{

                return 2;

            }
        }
    }

?>