<?php
//Conexión a la base de datos
$dbConn = Connection::connect();
dbObject::setDbCon($dbConn);

$page = isset($_GET['page'])?$_GET['page']:'inicio';

if(!empty($page)){
    
    $data = array(
        'inicio'            => PAGES.DS.'mainVisitor_view.php',
        'historial_torneos' => PAGES.DS.'tournamentHistory_view.php',
        'contacto'          => PAGES.DS.'contact_view.php',
        'ESO'               => PAGES.DS.'esoInfo_view.php',
        'sport'             => PAGES.DS.'sportInfo_view.php',
        'register'          => PAGES.DS.'register_view.php'
    );
    
    require_once(MODEL.DS."sport_class.php");
    //Recogemos lista de categorías
    $sports = new Sport();
    $allSports = $sports->getAll();
    
    foreach($data as $name => $url){
        if($page == $name){
            include_once($url);
        }else{
            require_once(PAGES.DS.'mainVisitor_view.php');
        }
    }
    //TODO: Sistema de clases para views, models y controllers  
    //TODO: Crear urls amigables
}else{
    
    require_once(MODEL.DS."sport_class.php");
    //Recogemos lista de categorías
    $sports = new Sport();
    $allSports = $sports->getAll();
    
    require_once(PAGES.DS.'mainVisitor_view.php');
    
}





// Petición de log de usuario
//if (isset($_POST['sendLog'])) {
//
//      require_once("login_controller.php"); 
//
//}







