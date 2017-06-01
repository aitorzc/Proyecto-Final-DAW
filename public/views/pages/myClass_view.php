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
foreach($allCourses as $c){
    if($c->getIdCurso() == $_SESSION['student']->getCurso_fk()){
        $idCurso = $c->getIdCurso();
        $curso = $c->getNombre();
    }
}
?>
<div class="container-fluid paddAll">
    <div class="panel panel-info">
        <div class="panel-heading"><span id="thisCourse" class="<?php echo $idCurso ?>">Alumnos de <?php echo $curso ?></span>
        </div>
        <div class="panel-body">
            <table id="classTable" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Usuario</th>
                        <?php
                        if(isset($_SESSION['user'])){
                            if($_SESSION['user']->getRango_fk() == 2){
                                echo "<th>Permiso</th>
                                      <th>Editar</th>
                                      <th>Eliminar</th>";
                            }
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($allStuds as $key => $value){
                        echo "<tr>";
                        echo "<td for='".$value->getIdAlumno()."' class='IdAlumno'>".$value->getIdAlumno()."</td>";
                        echo "<td class='Nombre ".$value->getNombre()."'>".$value->getNombre()."</td>";
                        echo "<td class='Apellido ".$value->getApellido()."'>".$value->getApellido()."</td>";
                        echo "<td class='Email ".$value->getEmail()."'>".$value->getEmail()."</td>";
                        echo "<td class='Usuario_fk ".$value->getUsuario_fk()."'>".$value->getUsuario_fk()."</td>";
                        if(isset($_SESSION['user'])){
                            if($_SESSION['user']->getRango_fk() == 2){
                                if($value->getPermiso() == 1){
                                    echo "<td><button class='btn btn-success btn-xs studPermis'><span class='glyphicon glyphicon-ok-circle'></span></button></td>";
                                }else{
                                    echo "<td><button class='btn btn-danger btn-xs studPermis'><span class='glyphicon glyphicon-ban-circle'></span></button></td>";
                                }
                                echo "<td><button class='btn btn-primary btn-xs editStud'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                                echo "<td><button class='btn btn-danger btn-xs deleteStud'><span class='glyphicon glyphicon-trash'></span></button></td>";
                            }
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <?php
            if(isset($_SESSION['user'])){
                if($_SESSION['user']->getRango_fk() == 2){
                    echo '<span id="addUser" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Crear usuario nuevo</span>';
                }
            }
            ?>
        </div>
    </div>
</div>
    <div class="hidden">
        <form id="createStudent">
            <fieldset>
                <div class="row">
                    <div class="col-xs-12 margin-bt">
                        <div class="col-xs-12 text-center">
                            <h3 class="margin-bt">Alumno</h3>
                        </div>
                        <div class='col-md-6'>
                            <label>Nombre</label>
                            <div class="form-group">
                                <input type="text" name="createName" value=""/><br><br>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <label>Apellido</label>
                            <div class="form-group">
                                <input type="text" name="createSurname" value=""/><br><br>
                            </div>
                        </div>
                        <div class='col-xs-6'>
                            <label>Email</label>
                            <div class="form-group">
                                <input type="text" name="createEmail" value=""/><br><br>
                            </div>
                        </div>
                        <div class='col-xs-6'>
                            <label>Curso</label>
                            <div class="form-group">
                                <input class="col-xs-12" name="createCourse" type="number" min="1" max="4" value=""/><br><br>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <div class="col-xs-12 text-center">
                            <h3 class="margin-bt">Usuario</h3>
                        </div>
                        <div class='col-md-6'>
                            <label>Login</label>
                            <div class="form-group">
                                <input type="text" name="createLogin" value=""/><br><br>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <label>Password</label>
                            <div class="form-group">
                                <input type="password" name="createPassword" value=""/><br><br>
                            </div>
                        </div>
                        <div class='col-xs-12'>
                            <label>Tipo</label>
                            <div class="form-group">
                                <label class="radio-inline"><input type="radio" checked="checked" value="1" name="userType">Alumno</label>
                                <label class="radio-inline"><input type="radio" value="2" name="userType">Profesor</label>
                            </div>
                        </div>
                        <div class='col-xs-12'>
                            <div class="form-group">
                                <input class="btn btn-primary col-xs-12" id="createStudentBtn" name="createStudentBtn" type="button" value="Crear">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
        <form id="modifyStudent">
            <fieldset>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12 text-center">
                            <h3>Alumno</h3>
                        </div>
                        <div class='col-md-6'>
                            <label>Nombre</label>
                            <div class="form-group">
                                <input type="text" class="hidden" name="studentIdMod" value=""/>
                                <input type="text" class="form-control" name="modifyName" value=""/>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <label>Apellido</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="modifySurname" value=""/>
                            </div>
                        </div>
                        <div class='col-xs-6'>
                            <label>Email</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="modifyEmail" value=""/>
                            </div>
                        </div>
                        <div class='col-xs-6'>
                            <label>Curso</label>
                            <div class="form-group">
                                <input class="col-xs-12 form-control" name="modifyCourse" type="text" value=""/>
                            </div>
                        </div>
                    </div>
                    <legend></legend>
                    <div class="col-xs-12">
                        <div class="col-xs-12 text-center">
                            <h3>Usuario</h3>
                        </div>
                        <div class='col-md-6'>
                            <label>Login</label>
                            <div class="form-group">
                                <input type="text" class="form-control" name="modifyUser" value="" disabled/>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <label>Password</label>
                            <div class="form-group">
                                <input type="password" class="form-control" name="modifyPassword" value="*******" disabled/>
                            </div>
                        </div>
                        <legend></legend>
                        <div class='col-xs-12'>
                            <div class="form-group">
                                <span class="btn btn-primary col-xs-12" name="saveStudentChanges">Guardar modificaciones</span>
                            </div>
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

