<?php
require_once(MODEL.DS."sport_class.php");
//Conexión a la base de datos
$dbConn = Connection::connect();
dbObject::setDbCon($dbConn);
// Inicio de buffer
ob_start();

if(isset($_GET['loginTry'])){
    include_once CONTROLLER.DS.'login_controller.php';
    echo "entra";
}


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
    'out'               => PAGES.DS.'logOut.php'
);
// Comprobación de paso por get
if(empty($page) || !key_exists($page, $data)){
    $page = 'inicio';
}


//Recogemos lista de categorías
$sports = new Sport();
$allSports = $sports->getAll();

foreach($data as $name => $url){
    if($page == $name){      
        //View::output($url);
        require_once $url;
    }else{
        View::output(PAGES.DS.'mainVisitor_view.php');
    }
}


//TODO: Sistema de clases para views, models y controllers  
//TODO: Crear urls amigables






// Petición de log de usuario
//if (isset($_POST['sendLog'])) {
//
//      require_once("login_controller.php"); 
//
//}

Connection::disconnect();





