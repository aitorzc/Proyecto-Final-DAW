<!DOCTYPE html>
<html>
<?php
//HEAD
include_once(INCLUDES.DS.'register_head.php'); 
?>
<body>
<?php
//HEADER
include_once(INCLUDES.DS.'main_header.php'); 
?>    
<div class="container">
    <div class="main-content">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="pill" href="#entrar">Entrar</a></li>
            <li><a data-toggle="tab" href="#contacta">Contáctanos</a></li>
        </ul>
        <div class="tab-content">
            <div id="entrar" class="tab-pane fade in active">
                <?php
                if($_SESSION['checkCaptcha'] == "OK"){
                ?>
                <form action="index.php?page=registro&tryLog=true" method="POST" class="form-horizontal margin-bt col-md-offset-1">
                    <div class="form-group margin-bt">
                        <label class='col-sm-offset-12'></label>
                        <label class='col-sm-offset-12'></label>
                        <label class="control-label col-sm-2">Nick:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="nickLog" onkeyup="logValidate()" id="nickLog" maxlength="12" placeholder="ej: johnTheExample">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Password:</label>
                        <div class="col-sm-8">          
                            <input type="password" class="form-control" onkeyup="logValidate()" name="pswdLog" id="pswdLog" maxlength="20" placeholder="ej: ex@mPl3">
                        </div>
                    </div>
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-8">
                            <input type="submit" name="sendLog" value="Enviar" id="sendLog" disabled class="btn btn-info">
                        </div>
                    </div>
                </form>
                <?php
                }else{
                    echo '<div class="col-sm-offset-12 margin-bt"></div><div class="col-sm-offset-3"><span style="font-size:14px" class="label label-danger">Usuario o contraseña incorrectos</span>';
                    require_once('public/libs/recaptcha/verify.php');
                    echo "</div>";
                }
                ?>
            </div>
            <div id="contacta" class="tab-pane fade">
                <form class="margin-bt">
                    <!-- Nombre-->
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-label" for="name"></label>
                        <div class="col-md-6">
                            <input id="name" name="name" type="text" placeholder="Tu nombre" class="form-control">
                        </div>
                    </div>

                    <!-- Email-->
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-label" for="email"></label>
                        <div class="col-md-6">
                            <input id="headers" name="email" type="text" placeholder="Tu email" class="form-control">
                        </div>
                    </div>

                    <!-- Mensaje -->
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-label" for="message"></label>
                        <div class="col-md-6">
                            <textarea class="form-control" id="message" name="message" placeholder="Introduzca su mensaje aquí..." rows="5"></textarea>
                        </div>
                    </div>

                    <!-- Enviar -->
                    <div class="form-group col-md-12">
                        <label class="col-md-3 control-label" for="send"></label>
                        <div class="col-md-1">
                            <span class="btn btn-primary" id="sendMail">Enviar</span>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>     
</div>
</body>
<?php
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>
</html>
