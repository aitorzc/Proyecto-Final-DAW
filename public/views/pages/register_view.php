<!DOCTYPE html>
<html>
<?php
//HEAD
include_once(INCLUDES.DS.'register_head.php'); 
?>
<body>
<div class="container">
    <div class="main-content">
        <ul class="nav nav-tabs nav-justified">
            <li class="active"><a data-toggle="pill" href="#entrar">Entrar</a></li>
            <li><a data-toggle="pill" href="#registrarme">Regístrate</a></li>
        </ul>
        <div class="tab-content">
            <div id="entrar" class="tab-pane fade in active">
                <form action="?loginTry=TRUE" method="POST" class="form-horizontal">
                    <div class="form-group">
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
                            <button type="submit" name="sendLog" id="sendLog" disabled class="btn btn-info">Entrar</button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="registrarme" class="tab-pane fade">
                <form action="" method="POST" class="form-horizontal">
                    <h6 class="text-center">Los campos marcados con * son obligatorios</h6>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nick:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nick" minlength="4" maxlength="15" placeholder="ej: johnTheExample *">
                            <span class="alert-danger">El nick debe contener entre 4 y 15 carácteres</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Nombre:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="nombre" maxlength="25" placeholder="ej: John Example">
                            <span class="alert-danger">El nombre debe empezar por mayúscula</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Email:</label>
                        <div class="col-sm-8">
                            <input type="email" class="form-control" id="email" maxlength="30" placeholder="ej: example@example.example *">
                            <span class="alert-danger">Por favor, introduzca un correo válido</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Password:</label>
                        <div class="col-sm-8">          
                            <input type="password" class="form-control" id="pswd" maxlength="20" placeholder="ej: ex@mPl3 *">
                            <span class="alert-danger">La contraseña debe contener una minúscula, una mayúscula , un número y comprendido entre 4 y 20 carácteres</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2">Repetir Password:</label>
                        <div class="col-sm-8">          
                            <input type="password" class="form-control" id="pswd2" maxlength="20" placeholder="ej: ex@mPl3 *">
                            <span class="alert-danger">Las contraseñas deben coincidir</span>
                        </div>
                    </div>
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-8">
                            <div class="checkbox">
                                <label><input type="checkbox" checked="checked"> Acepto los términos y condiciones</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">        
                        <div class="col-sm-offset-2 col-sm-8">
                            <button type="submit" disabled class="btn btn-info">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>     
</div>
</body>
</html>
