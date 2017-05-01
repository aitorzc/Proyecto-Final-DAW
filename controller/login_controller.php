<?php
$userLog = $_POST['nickLog'];
$pswdLog = $_POST['pswdLog'];

checklogin($userLog, $pswdLog);

function checkLogin($userLog, $pswdLog){

    $user = new User();
    $allUsers = $user->getAll();
    $userNames = array();
    
    foreach($allUsers as $users){
        $login = $users->Login;
        $pass = $users->Password;
        $userNames[$login] = $pass;
    }
    
    if(array_key_exists($userLog, $userNames)){
        echo "existe usuario: ".$userLog."<br>";
        if($userNames[$userLog] == $pswdLog){
            echo "contraseña corecta: ".$pswdLog;
            loginAccess($userLog, $pswdLog);
        }else{
            echo "dato incorrecto";
            return false;
        }
    }else{
        return false;
        header('Location:'.ROOT.DS.'index.php?page=registro');
    }
}
// Crear sesion para el nuevo usuario y comprobar su rango
function loginAccess($userLog, $pswdLog){

    $_SESSION['user'] = new User();
    $_SESSION['user']->setLogin($userLog);
    $_SESSION['user']->setPswd($pswdLog);
    return true;
}
