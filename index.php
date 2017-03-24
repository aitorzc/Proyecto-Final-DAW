<!doctype html>

<html>
<head>
    <meta charset="UTF-8">
</head>

<body>

<?php
    
    session_start();

    if(!isset($_SESSION['user'])){
        
        require_once("controller/main_controller.php");

    }
?>    

</body>
</html>