<!DOCTYPE html>
<html>
<?php
//HEAD
include_once(INCLUDES.DS.'main_head.php'); 
?>  
<body> 
<?php
//HEADER
include_once(INCLUDES.DS.'main_header.php'); 
?>
<div class="container-fluid paddAll">
    <?php
    $studs = new Student();
    $curso = $_SESSION['student']->getCurso_fk();
    $selectStuds = array('*');
    $allStuds = $studs->selectWhere($selectStuds, 'Curso_fk = '.$curso.'');
    foreach ($allStuds as $stud){
        echo $stud->getNombre()."<br>";
    }
    ?>
</div>
<?php
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>    
</body>
</html>

