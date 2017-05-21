<?php
//Conexión a la base de datos
$dbConn = Connection::connect();
dbObject::setDbCon($dbConn);

session_start();
if(isset($_GET['isAjaxReq'])){
    return include_once CONTROLLER.DS.'action_controller.php';
}
if(isset($_GET['playingUser'])){
    
}
if(isset($_GET['notPlayingUser'])){
    
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
if(isset($_GET['page'])){
    if($_GET['page'] == 'out'){
        session_destroy();
        $_GET['page'] = 'registro';
    }
}
if(isset($_GET['delTournament'])){
    deleteTournament($_GET['delTournament']);
}
if(isset($_GET['startTournament'])){
    $stringTourn = startTournament($_GET['startTournament']);
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
    'mi_perfil'         => PAGES.DS.'myProfile_view.php',
    'mi_clase'          => PAGES.DS.'myClass_view.php',
    'gestion_torneos'   => PAGES.DS.'gestionTorneos_view.php'
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
//Recogemos lista de cursos
$courses = new Course();
$allCourses = $courses->getAll();
//Recogemos lista de estudiantes
$students = new Student();
$allStudents = $students->getAll();
$tournaments = new Tournament();
$allTournaments = $tournaments->getAll();
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





