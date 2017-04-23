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
    <h2 class="text-center">Nuevo torneo</h2>
    <form>
    <div class="row">
        <div class="form-group ">
            <h3>Paso 1: ¿Qué vamos a jugar?</h3>
            <div class="col-xs-3 col-sm-3">
                <select name="sportName" class="form-control">
                    <option disabled selected hidden>Elige deporte</option>
                    <?php
                            // Lista de deportes
                            for ($i = 0; $i < count($matrizDeportes); $i++) {
                                $deporte = $matrizDeportes[$i]->getNombre();
                                echo "<option value='$deporte'>" . $deporte . "</option>";
                            }
                        ?>
                </select>
            </div>
            <div class="col-xs-3 col-sm-3"> 
                <select name="gameMode" class="form-control">
                    <option disabled selected hidden>Elige tipo de torneo</option>
                    <option>Eliminatoria</option>
                    <option>Liga</option>
                </select>
            </div>
            <div class="col-xs-3 col-sm-3">
                <select name="gameType" class="form-control">
                    <option disabled selected hidden>Elige tipo de agrupación</option>
                    <option>Individual</option>
                    <option>Por equipos</option>
                </select>
            </div>
        </div>
        <div class="stage" id="img1">

        </div>
    </div>
    <div class="row">
        <div class="form-group">
            <h3>Paso 2: ¿Quién juega?</h3>  
            <div class="col-xs-3 col-sm-3">
                <select name="userCourse" class="form-control">
                    <option disabled selected hidden>Elige curso</option>
                    <option>1r ESO</option>
                    <option>2n ESO</option>
                    <option>3r ESO</option>
                    <option>4rt ESO</option>
                </select>
            </div>
            <div class="col-xs-1 col-sm-1">
                <select name="numPlayers" class="form-control">
                    <option disabled selected hidden>Nº jugadores</option>
                    <option>8</option>
                    <option>12</option>
                    <option>16</option>
                    <option>20</option>
                    <option>24</option>
                </select>
            </div>    
            <div class="col-xs-5 col-sm-5">
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
                <label class="checkbox-inline"><input type="checkbox" value="">Option 1</label>
            </div>
        </div>
        <div class="stage">

        </div>
    </div>
    <div class="row">
        <div class"form-group">
            <h3>Paso 3: Especificaciones</h3>
            <div class="col-xs-3 col-sm-3">
            <div class='input-group date' id='datetimepicker'>
                 <input type='text' value="Elige fecha" class="form-control" />
                 <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                 </span>
            </div>
        </div>
        <div class="form-group">
            <div class="col-xs-6 col-sm-6">
            <textarea class="form-control" rows="5" id="comment" placeholder="Añadir comentario para los alumnos (opcional)"></textarea>
        </div>
    </div>
    <div class="stage">

    </div>
    <div class="row">
        <div class="col-xs-5">
        <input type="submit" class="btn btn-info" value="Crear torneo" name="sendNewTourn">
    </div>
    </form>
</div>
<?php
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>            
</body>
</html>



