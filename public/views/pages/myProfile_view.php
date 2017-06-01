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
<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xs-offset-0 col-sm-offset-0 col-md-offset-3 col-lg-offset-3" >
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $_SESSION['student']->getNombre()." ".$_SESSION['student']->getApellido() ?></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <form action="index.php?page=mi_perfil&saveProfileResults=true" id="profileForm" enctype="multipart/form-data" method="POST">
                    <div class="col-xs-3 col-xs-3 imgContainer" align="center"> 
                        <img id="imgProfile" alt="Foto" src="<?php echo "public/images/users/".$_SESSION['user']->getAvatar()?>" class="img-circle img-responsive">
                        <div id="fadeEffect">
                            <div class="textEffect">
                                <span id="selImg" class="btn selFile">Elige una imagen</span>
                                <input type="file" id="inpFile" name="inpFile" class="file-loading hidden">
                            </div>
                            <progress></progress>
                        </div>
                    </div>
                <div class=" col-xs-9 col-xs-9 "> 
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Usuario</td>
                                <td><?php echo $_SESSION['user']->getLogin(); ?></td>
                            </tr>
                            <tr>
                                <td>Contraseña</td>
                                <td class="editPasswd">**************</td>
                                <td class="editPasswd" style="display: none;">
                                    <div class="col-xs-12">
                                        <span class="btn btn-primary changePass col-xs-12">Cambiar contraseña</span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Nombre</td>
                                <td><?php echo $_SESSION['student']->getNombre() ?></td>
                            </tr>
                            <tr>
                                <td>Apellido</td>
                                <td><?php echo $_SESSION['student']->getApellido() ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td class="editEmail">
                                    <?php echo $_SESSION['student']->getEmail() ?>
                                </td>
                                    <td class="editEmail" style="display: none;">
                                        <div class="col-xs-12">
                                            <input class="form-control col-xs-12" name="cambiarEmail" id="cambiarEmail" value="<?php echo $_SESSION['student']->getEmail() ?>" type="text">
                                        </div>
                                    </td>
                                </form>
                            </tr>
                            <tr>
                                <td>Curso</td>
                                <td><?php echo $_SESSION['student']->getCurso_fk() ?></td>
                            </tr>
                            <tr>
                                <td>Estado</td>
                                <?php verPermiso(); ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </form>
            </div>
        </div>
        <div class="panel-footer">
            <a id="btnEditProfile" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
            <button type="submit" id="btnSaveProfile" style="display: none;" class="btn btn-sm btn-primary"><i class="glyphicon glyphicon-save"></i></button>
            <a id="btnCancelProfile" style="display: none;" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
            <?php 
            if(isset($responseMessage)){
                echo $responseMessage;
            }
            ?>
        </div>
    </div>
</div>
    <div class="hidden">
        <form id="changePassword">
            <fieldset>
                <div class="row">
                    <div class="col-xs-12 margin-bt">
                        <h3 class="margin-bt text-center">Cambiar contraseña</h3>
                        <span class="text-left">Contraseña actual:</span>
                    <div class="input-group">
                        <span class="input-group-addon btn btn-info verPswd" id="basic-addon1">
                            <span>👁</span>
                        </span>
                        <input type="password" id="actualPass" min="8" max="30" placeholder="contraseña actual" class="form-control">
                    </div>
                    </div>
                    <div class="col-xs-12 margin-bt">
                        <span class="text-left">Contraseña nueva:</span>
                        <div class="input-group">
                            <span class="input-group-addon btn btn-info verPswd" id="basic-addon1">
                                <span>👁</span>
                            </span>
                            <input type="password" id="cambiarPswd" min="8" max="30" placeholder="contraseña nueva" class="form-control">
                        </div>
                    </div>
                    <legend></legend>
                    <div class="col-xs-12">
                        <div class="input-group col-xs-12">
                            <input type="button" id="savePass" value="Guardar contraseña" class="btn btn-primary col-xs-12">
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
<?php
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>    
</body>
</html>