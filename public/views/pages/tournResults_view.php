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
    <div class="panel panel-info">
        <div class="panel-heading">Resultados
        </div>
        <div class="panel-body">
            <?php
            echo $res[1];
            ?>
            <div class="row col-sm-12">
                <p class="col-sm-4"></p>
                <h2 class="label-warning col-sm-4 text-center rad"><?php echo $res[0]; ?></h2>
                <p class="col-sm-4"></p>
            </div>    
        </div>
    </div>    
    
</div>    
<?php
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>    
</body>
</html>