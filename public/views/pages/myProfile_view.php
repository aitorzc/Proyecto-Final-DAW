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
            <h3 class="panel-title"><?php echo $_SESSION['user']->getNombre()." ".$_SESSION['user']->getApellido() ?></h3>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php echo "public/images/users/".$_SESSION['user']->getImg()?>" class="img-circle img-responsive"> 
                </div>
                <div class=" col-md-9 col-lg-9 "> 
                    <table class="table table-user-information">
                        <tbody>
                            <tr>
                                <td>Usuario</td>
                                <td><?php echo $_SESSION['user']->getLogin() ?></td>
                            </tr>
                            <tr>
                                <td>Contraseña</td>
                                <td>**************</td>
                            </tr>
                            <tr>
                                <td>Nombre</td>
                                <td><?php echo $_SESSION['user']->getNombre() ?></td>
                            </tr>
                            <tr>
                                <td>Apellido</td>
                                <td><?php echo $_SESSION['user']->getApellido() ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td class="editEmail"><?php echo $_SESSION['user']->getEmail() ?></td>
                                <form action="index?page=mi_perfil&edit=email" method="POST">
                                    <td class="editEmail" style="display: none;">
                                        <input type="text" class="editEmail">
                                        <input type="submit" class="editEmail"
                                    </td>
                                </form>
                            </tr>
                            <tr>
                                <td>Curso</td>
                                <td><?php echo $_SESSION['user']->getCurso() ?></td>
                            </tr>
                            <tr>
                                <td>Estado</td>
                                <?php verPermiso(); ?>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="panel-footer">
            <a type="button" value="" class="btn btn-sm btn-warning"><i class="glyphicon glyphicon-edit"></i></a>
            <span class="pull-right">
                <a data-original-title="Eliminar usuario" data-toggle="tooltip" type="button" class="btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
            </span>
        </div>
    </div>
</div>
<?php
//FOOTER
//include_once(INCLUDES.DS.'main_footer.php'); 
?>    
</body>
</html>