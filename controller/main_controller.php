<?php
require_once MODEL.DS."sport_class.php";
require_once MODEL.DS."category_class.php";
include_once MODEL.DS.'user_class.php';

//Conexión a la base de datos
$dbConn = Connection::connect();
dbObject::setDbCon($dbConn);
session_start();
if(isset($_GET['crearTorneo'])){
    echo "torneo creado<br>";
}
if(isset($_GET['tryLog'])){
    $userLog = $_POST['nickLog'];
    $pswdLog = $_POST['pswdLog'];
    
    if(checkLogin($userLog, $pswdLog)){
        $_GET['page'] = 'inicio';
    }else{
        $_GET['tryLog'] = false;
    }
}
// Inicio de buffer
ob_start();

// Parámetro para elegir página
$page = isset($_GET['page'])?$_GET['page']:'inicio';

$data = array(
    'inicio'            => PAGES.DS.'mainVisitor_view.php',
    'historial_torneos' => PAGES.DS.'tournamentHistory_view.php',
    'contacto'          => PAGES.DS.'contact_view.php',
    'ESO'               => PAGES.DS.'esoInfo_view.php',
    'sport'             => PAGES.DS.'sportInfo_view.php',
    'registro'          => PAGES.DS.'register_view.php',
    'nuevo_torneo'      => PAGES.DS.'newTournament_view.php',
    'out'               => PAGES.DS.'logOut.php',
    'mi_perfil'         => PAGES.DS.'myProfile_view.php'
);
// Comprobación de paso por get
if(empty($page) || !key_exists($page, $data)){
    $page = 'inicio';
}
//Recogemos lista de deportes
$sports = new Sport();
$allSports = $sports->getAll();
//Recogemos lista de categorías
$categories = new Category();
$allCategs = $categories->getAll();
//Alumnos permitidos
$allowedUsers = new User();
$arrAllowedUsers =$allowedUsers->getAll();
$alumnos1 = array();
$alumnos2 = array();
$alumnos3 = array();
$alumnos4 = array();

foreach ($arrAllowedUsers as $user){
    if($user->Permiso == 1 && $user->Curso == 1){
        array_push($alumnos1, $user->Nombre);
    }
    if($user->Permiso == 1 && $user->Curso == 2){
        array_push($alumnos2, $user->Nombre);
    }
    if($user->Permiso == 1 && $user->Curso == 3){
        array_push($alumnos3, $user->Nombre);
    }
    if($user->Permiso == 1 && $user->Curso == 4){
        array_push($alumnos4, $user->Nombre);
    }
}
foreach($data as $name => $url){
    if($page == $name){   
        //Función para que el output de html no se acumule
        View::cleanBuffer();
        require_once $url;
    }
}


//TODO: Sistema de clases para views, models y controllers  
//TODO: Crear urls amigables


Connection::disconnect();





