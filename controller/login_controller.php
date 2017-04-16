<?php
include_once MODEL.DS.'user_class.php';
session_start();

$userLog = $_POST['nickLog'];
$pswdLog = $_POST['pswdLog'];

checklogin();

function checkLogin(){

    $user = new User();
    $allUsers = $user->getAll();
    $userNames = array();
    
    foreach($allUsers as $users){
       array_push($userNames[$users['Login']], $users['Password']);
    }
    
    if(array_key_exists($userLog, $userNames)){
        if($userNames[$userLog] == $pswdLog){
            loginAccess();
        }
    }
}
// Crear sesion para el nuevo usuario y comprobar su rango
function loginAccess($user){

    $_SESSION['user'] = new User();
    $_SESSION['user']->setLogin($userLog);
    $_SESSION['user']->setPswd($pswdLog);
    header('Location:'.ROOT.DS.'index.php');
}


?>