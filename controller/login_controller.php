<?php

    include_once("model/userList_model.php");
    include_once("model/user_class.php");

// Peticion de login
    if (isset($_POST['sendLog'])) {

       checklogin();

    }

    function checkLogin(){

        $userLog = $_POST['nickLog'];
        $pswdLog = $_POST['pswdLog'];

        $userList = new userList();

        $message = "";
            
        $userResult = $userList->findUser($userLog);

        if($userResult->getLogin() == $userLog){

            if($userResult->getPswd() == $pswdLog){

                $message = "Bienvenido ". $userLog;
                echo $message;
                loginAccess($userResult);
            }
            
        }else{

            $message = "Nick o password erroneos";
            echo $message;
        }

    }
// Crear sesion para el nuevo usuario y comprobar su rango
    function loginAccess($user){

         $_SESSION['user'] = $user;

         if (checkUserRange() == 2) {

            header("Location: view/management");

         }else{

            header("Location: ./");

         }
         
    }
// Funcion para comprobar rango
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