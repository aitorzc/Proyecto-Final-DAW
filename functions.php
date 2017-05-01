<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE LOGIN
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function checkLogin($userLog, $pswdLog){

    $user = new User();
    $selectVals = array("Login", "Password", "Email", "Nombre", "Apellido", "Curso", "Avatar", "Rango", "Permiso");
    $where = "Login = '{$userLog}' AND Password = '{$pswdLog}'";
    $result = $user->selectWhere($selectVals, $where);
    if(empty($result)){
        return false;
    }else{
        $_SESSION['user'] = new User();
        $_SESSION['user']->setLogin($result[0]->Login);
        $_SESSION['user']->setPswd($result[0]->Password);
        $_SESSION['user']->setNombre($result[0]->Nombre);
        $_SESSION['user']->setApellido($result[0]->Apellido);
        $_SESSION['user']->setEmail($result[0]->Email);
        $_SESSION['user']->setImg($result[0]->Avatar);
        $_SESSION['user']->setRango($result[0]->Rango);
        $_SESSION['user']->setCurso($result[0]->Curso);
        $_SESSION['user']->setPermiso($result[0]->Permiso);
        return true;
    }
}    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNIONES DE AYUDA
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function echopre($expression){
    
    echo "<pre>".print_r($expression)."</pre>";
    
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNIONES DE PEFIL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function verPermiso(){
    $value = $_SESSION['user']->getPermiso();
    if($value){
        echo "<td style='color:green'>¡Puedes participar en torneos!</td>";
    }else{
        echo "<td style='color:red'>No puedes participar en los torneos.</td>";
    }
}