<?php
//Conexión a la base de datos
$dbConn = Connection::connect();
dbObject::setDbCon($dbConn);

session_start();

// Action controller for ajax requests
if(isset($_GET['isAjaxReq'])){
    return include_once CONTROLLER.DS.'AJAXaction_controller.php';
}
// PETICIONES 
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Login
if(!isset($_SESSION['checkCaptcha'])){
    $_SESSION['checkCaptcha'] = "OK";
}
if(isset($_GET['tryLog'])){
    
    $userLog = isset($_POST['nickLog'])?$_POST['nickLog']:"";
    $pswdLog = isset($_POST['pswdLog'])?$_POST['pswdLog']:"";

    if(checkLogin($userLog, $pswdLog)){
        $_GET['page'] = 'inicio';
    }else{
        $_GET['tryLog'] = false;
        $_SESSION['checkCaptcha'] = "BAD";
    }
}

//GESTOR DEPORTES

//Crear un deporte
if(isset($_GET['createSport'])){
    if(!empty($_FILES['createImg']['name'])){
        $imagen = $_FILES['createImg'];
        $nombre = $_POST['createSportName'];
        $descripcion = $_POST['createSportDesc'];
        $responseMessage = createSport($nombre, $descripcion, $imagen);
        if($responseMessage === true){
            $responseMessage = "Deporte creado";
        }
    }else{
        $responseMessage = "Elija una imagen para el nuevo deporte por favor.";
    }
}
//Modificar un deporte
if(isset($_GET['modifySport'])){
    $id = $_POST['idSport'];
    $imagen = $_FILES['modifyImg'];
    $nombre = $_POST['modifySportName'];
    $descripcion = $_POST['modifySportDesc'];
    if(!empty($_FILES['modifyImg']['name'])){
        $responseMessage = modifySport($id, $nombre, $descripcion, $imagen, true);
        if($responseMessage === true){
            $responseMessage = "Cambios guardados";
        }
    }else{
        $responseMessage = modifySport($id, $nombre, $descripcion, "");
    }
}
//Mi PERFIL

//Guardar cambios de perfil
if(isset($_GET['saveProfileResults'])){
    if($_FILES['inpFile']['tmp_name'] != ""){
        $responseMessage = uploadImage();
        if($responseMessage === true){
            $responseMessage = "Cambios guardados";
        }
    }
    if($_POST['cambiarEmail'] != $_SESSION['student']->getEmail()){
        changeEmail($_POST['cambiarEmail']);
    }
    
}
//TORNEOS

//Empezar torneo
if(isset($_GET['startTournament'])){
    $stringTourn = startTournament($_GET['startTournament']);
}
//Recoger torneos que ya se hayan jugado
if(isset($_GET['page'])){
    if($_GET['page'] == 'historial_torneos'){
        $tournsHistory = new Tournament();
        $allTournsByDate = $tournsHistory->selectAdd('DISTINCT A.*', 'A INNER JOIN ronda B ON A.IdTorneo = B.IdTorneo_fk WHERE b.IdGanador_fk IS NOT NULL');
    }
}
//Mostrar resultados torneo
if(isset($_GET['showResults'])){
    //Si el torneo es el último
    if(isset($_GET['lastRes'])){
        //Si no estas logueado redireccion para loguearse
        if(!isset($_SESSION['user'])){
            $_GET['page'] = 'registro';
        }else{
            //Mostrar resultado del último torneo
            $res = checkResultsType(showLastTourn());
            $_GET['page'] = 'results';
        }
    //Mostrar resultado del torneo solicitado    
    }else{
        $res = checkResultsType($_GET['showResults']);
    }
}
//PAGE es el parámetro para elegir que página se esta viendo
if(isset($_GET['page'])){
    if($_GET['page'] == 'out'){
        session_destroy();
        $_GET['page'] = 'registro';
    }
}

// Inicio de buffer
ob_start();

// Parámetro para elegir página
$page = isset($_GET['page'])?$_GET['page']:'inicio';
//Traductor del valor de page a cada página
$data = array(
    'inicio'            => PAGES.DS.'mainVisitor_view.php',
    'historial_torneos' => PAGES.DS.'tournamentHistory_view.php',
    'contacto'          => PAGES.DS.'contact_view.php',
    '1ESO'              => PAGES.DS.'esoInfo1_view.php',
    '2ESO'              => PAGES.DS.'esoInfo2_view.php',
    '3ESO'              => PAGES.DS.'esoInfo3_view.php',
    '4ESO'              => PAGES.DS.'esoInfo4_view.php',
    'infoSports'        => PAGES.DS.'sportInfo_view.php',
    'registro'          => PAGES.DS.'register_view.php',
    'nuevo_torneo'      => PAGES.DS.'newTournament_view.php',
    'mi_perfil'         => PAGES.DS.'myProfile_view.php',
    'mi_clase'          => PAGES.DS.'myClass_view.php',
    'gestion_torneos'   => PAGES.DS.'gestionTorneos_view.php',
    'results'           => PAGES.DS.'tournResults_view.php',
    'gestion_deportes'  => PAGES.DS.'gestionSports_view.php'
);
// Comprobación de paso por get
if(empty($page) || !key_exists($page, $data)){
    $page = 'inicio';
}
//Control de permiso de usuarios no logueados
if(!isset($_SESSION['user']) && ($page == 'mi_perfil' || $page == 'mi_clase' || $page == 'nuevo_torneo' || $page == 'results' || $page == 'gestion_torneos' || $page == 'gestion_deportes')){
    $page = 'inicio';
}
//Control de permiso de usuarios estudiantes
if(isset($_SESSION['user'])){
    if($_SESSION['user']->getRango_fk() == 1 && ($page == 'gestion_torneos' || $page == 'nuevo_torneo' || $page == 'gestion_deportes')){
        $page = 'inicio';
    }
}
//EXTRACCIÓN DE DATOS BASE
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
$studs = new Student();

if(isset($_SESSION['student'])){
    $selectStuds = array('*');
    $allStuds = $studs->selectWhere($selectStuds, 'Curso_fk = '.$_SESSION['student']->getCurso_fk().' ORDER BY Permiso DESC, Nombre ASC');
}
$selNameUser = 'Nombre, Usuario_fk, Apellido';
$studsCourse = new Student();
$studs1ESO = $studsCourse->selectAdd($selNameUser, 'WHERE Curso_fk = 1 AND Permiso = 1 ORDER BY Nombre DESC');
$studs2ESO = $studsCourse->selectAdd($selNameUser, 'WHERE Curso_fk = 2 AND Permiso = 1 ORDER BY Nombre DESC');
$studs3ESO = $studsCourse->selectAdd($selNameUser, 'WHERE Curso_fk = 3 AND Permiso = 1 ORDER BY Nombre DESC');
$studs4ESO = $studsCourse->selectAdd($selNameUser, 'WHERE Curso_fk = 4 AND Permiso = 1 ORDER BY Nombre DESC');

//MOSTRAR VISTA
foreach($data as $name => $url){
    if($page == $name){   
        //Función para que el output de html no se acumule
        View::cleanBuffer();
        require_once $url;
    }
}


//Fin de conexión
Connection::disconnect();





