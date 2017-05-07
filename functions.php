<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE LOGIN
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function checkLogin($userLog, $pswdLog){

    $user = new User();
    $selectValsUser = array("*");
    $whereUser = "Login = '{$userLog}' AND Password = '{$pswdLog}'";
    $result = $user->selectWhere($selectValsUser, $whereUser);
    $_SESSION['user'] = $result[0];
    
    if(empty($_SESSION['user'])){
        return false;
    }else{
        $student = new Student();
        $selectValsStud = array("*");
        $log = $_SESSION['user']->getLogin();
        $whereStud = "Usuario_fk = '{$log}'";
        $result = $student->selectWhere($selectValsStud, $whereStud);
        $_SESSION['student'] = $result[0];
        return true;
    }
}    

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNIONES DE NUEVO TORNEO
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function generateTeams(array $students){
    shuffle($students);
    $size = count($students)/2;
    return array_chunk($students, $size);
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE AYUDA
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function echopre($expression){
    
    echo "<pre>".print_r($expression)."</pre>";
    
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNIONES DE PEFIL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function verPermiso(){
    $value = $_SESSION['student']->getPermiso();
    if($value){
        echo "<td style='color:green'>¡Puedes participar en torneos!</td>";
    }else{
        echo "<td style='color:red'>No puedes participar en los torneos.</td>";
    }
}