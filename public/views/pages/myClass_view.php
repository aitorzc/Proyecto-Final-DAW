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
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Email</th>
                        <th>Usuario</th>
                        <th>Permiso</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $studs = new Student();
                    $selectStuds = array('*');
                    $allStuds = $studs->selectWhere($selectStuds, 'Curso_fk = '.$_SESSION['student']->getCurso_fk().' ORDER BY Permiso DESC, Nombre ASC');
                    foreach ($allStuds as $key => $value){
                        echo "<tr>";
                        echo "<td class='IdAlumno' id='".$value->getIdAlumno()."'>".$value->getIdAlumno()."</td>";
                        echo "<td class='Nombre ".$value->getNombre()."'>".$value->getNombre()."</td>";
                        echo "<td class='Apellido ".$value->getApellido()."'>".$value->getApellido()."</td>";
                        echo "<td class='Email ".$value->getEmail()."'>".$value->getEmail()."</td>";
                        echo "<td class='Usuario_fk ".$value->getUsuario_fk()."'>".$value->getUsuario_fk()."</td>";

                        if($value->getPermiso() == 1){
                            echo "<td><button class='btn btn-success btn-xs studPermis'><span class='glyphicon glyphicon-ok-circle'></span></button></td>";
                        }else{
                            echo "<td><button class='btn btn-danger btn-xs studPermis'><span class='glyphicon glyphicon-ban-circle'></span></button></td>";
                        }
                        echo "<td><button class='btn btn-primary btn-xs editStud'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                        echo "<td><button class='btn btn-danger btn-xs deleteStud'><span class='glyphicon glyphicon-trash'></span></button></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <span id="addUser" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Crear usuario nuevo</span>
        </div>
    </div>
</div>
    <div class="hidden">
        <form id="createStudent">
            <fieldset>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12 text-center">
                            <h3>Alumno</h3>
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
                    <legend></legend>
                    <div class="col-xs-12">
                        <div class="col-xs-12 text-center">
                            <h3>Usuario</h3>
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
                                <label class="radio-inline"><input type="radio" value="1" name="userType">Alumno</label>
                                <label class="radio-inline"><input type="radio" value="2" name="userType">Profesor</label>
                            </div>
                        </div>
                        <div class='col-xs-12'>
                            <div class="form-group">
                                <input class="btn btn-primary col-xs-12" name="createStudent" type="submit" value="Crear">
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
                                <input type="text" name="modifyName" value=""/><br><br>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <label>Apellido</label>
                            <div class="form-group">
                                <input type="text" name="modifySurname" value=""/><br><br>
                            </div>
                        </div>
                        <div class='col-xs-6'>
                            <label>Email</label>
                            <div class="form-group">
                                <input type="text" name="modifyEmail" value=""/><br><br>
                            </div>
                        </div>
                        <div class='col-xs-6'>
                            <label>Curso</label>
                            <div class="form-group">
                                <input class="col-xs-12" name="modifyCourse" type="number" min="1" max="4" value=""/><br><br>
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
                                <input type="text" name="modifyUser" value=""/><br><br>
                            </div>
                        </div>
                        <div class='col-md-6'>
                            <label>Password</label>
                            <div class="form-group">
                                <input type="password" name="modifyPassword" value=""/><br><br>
                            </div>
                        </div>
                        <div class='col-xs-12'>
                            <div class="form-group">
                                <input class="btn btn-primary col-xs-12" name="saveStudentChanges" type="submit" value="Guardar modificaciones">
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

