<!doctype html>

<html>
<head>
    <meta charset="UTF-8">
</head>

<body>

<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(dirname(__FILE__)));

define('CSS', ROOT.DS.'public'.DS.'css');
define('IMAGES', ROOT.DS.'public'.DS.'images');
define('JS', ROOT.DS.'public'.DS.'js');
define('VIEWS', ROOT.DS.'public'.DS.'views');

define('INCLUDES', VIEWS.DS.'includes');
define('PAGES', VIEWS.DS.'pages');

$page = $_GET['page']?$_GET['page']:'main';
if(!empty($page)){
    
    $data = array(
        'main' => 'controller/main_controller.php',
        'main_user' => 'controller/mainUser_controller.php',
    );
    
    foreach($data as $name => $url){
        if($page == $name){
            
            include_once($url);
            
        }else{
            include_once('controller/main_controller.php');
        }
    }
    //TODO: Sistema de clases para views, models y controllers  
    //TODO: Crear urls amigables
}
?>

</body>
</html>