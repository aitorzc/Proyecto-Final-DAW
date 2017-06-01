<!DOCTYPE html>
<html>

<?php
//HEAD
include_once(INCLUDES.DS.'infoSports_head.php'); 
?>  

<body> 
    
<?php
//HEADER
include_once(INCLUDES.DS.'main_header.php'); 
?>
    
<div class="container-fluid paddAll">
    <div class="container text-center">
	<div class="row">
		<h4>Estos son los deportes que practicamos</h4>
	</div>
    <hr>
    <?php
    foreach($allSports as $allS){
        
    ?>
        <div class="row row-margin-bottom">
        <div class="col-md-offset-3 col-md-5 no-padding lib-item">
            <div class="lib-panel">
                <div class="row box-shadow">
                    <div class="col-md-6">
                        <img width="400px" height="250px" class="lib-img-show" src="<?php echo "public/images/new_tournament/".$allS->getImagen(); ?>">
                    </div>
                    <div class="col-md-6 text-left">
                        <div class="lib-row lib-header">
                            <?php echo $allS->getNombre(); ?>
                            <div class="lib-header-seperator"></div>
                        </div>
                        <div class="lib-row lib-desc">
                            <?php echo $allS->getDescripcion(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            </div>
    <?php  } ?>    
    
</div>
</div>
<?php
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>
</body>
</html>