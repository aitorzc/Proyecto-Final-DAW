<?php
session_start();
// Petición de log de usuario
if (isset($_POST['sendLog'])) {

      require_once("login_controller.php"); 

}


// Comprobación de log de usuario y rango 
if(isset($_SESSION['user'])){
    echo "logueado";
    $range = $_SESSION['user']->getRango();
    
    if($range == 1){

        require_once("model/sportList_model.php");
        require_once("view/management/index.php");
        //Recogemos lista de categorías
        $deportes = new sportList();
        $matrizDeportes = $deportes->getSportList();
    }

}else{
    echo "no logueado";
    require_once("model/sportList_model.php");
    require_once("view/main/prototype_web.php");
    //Recogemos lista de categorías
    $deportes = new sportList();
    $matrizDeportes = $deportes->getSportList();

}    

?>