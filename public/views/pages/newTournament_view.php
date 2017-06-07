<!DOCTYPE html>
<html>
    <?php
//HEAD
    include_once(INCLUDES . DS . 'newTournament_head.php');
    ?>  
    <body> 
        <?php
//HEADER
        include_once(INCLUDES . DS . 'main_header.php');
        if(!isset($_GET['crearTorneo']) && !isset($_GET['torneoCreado'])){
        ?>
        <div class="container-fluid paddAll">
            <h2 class="text-center">Nuevo torneo</h2>
            <form action="?page=nuevo_torneo&crearTorneo=true" method="POST">
                <div class="row">
                    <div class="form-group ">
                        <h3>Paso 1: ¿Qué vamos a jugar?</h3>
                        
                        <!--Elegir el nombre del torneo-->
                        
                        <div class="col-xs-3 col-sm-3"> 
                            <input class="form-control selectpicker" placeholder="Elige un nombre para el torneo" type="text" name="nameTournament">
                        </div>

                        <!--Elegir deporte para el torneo-->
                        
                        <div class="col-xs-3 col-sm-3">
                            <select name="sportName" class="form-control selectpicker">
                                <option value="0" disabled selected hidden>Elige deporte</option>
                                <?php
                                // Lista de deportes
                                foreach ($allSports as $sport) {
                                    echo "<option value='".$sport->getId().",".$sport->getNombre()."'>".$sport->getNombre()."</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!--Elegir el modo de agrupación de jugadores (individual, por equipos)-->
                        
                        <div class="col-xs-3 col-sm-3">
                            <select name="gameType" class="form-control selectpicker">
                                <option value="0" disabled selected hidden>Elige tipo de agrupación</option>
                                <option value="Individual">Individual</option>
                                <option value="PorEquipos">Por equipos</option>
                            </select>
                        </div>
                    </div>
                    <div class="stage" id="img1">

                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <h3>Paso 2: ¿Quién juega?</h3>  

                        <!--Elegir que curso juega-->
                        
                        <div class="col-xs-3 col-sm-3">
                            <select name="userCourse" id="elegirCurso" class="form-control selectpicker">
                                <option value="0" disabled selected hidden>Elige curso</option>
                                <?php
                                // Lista de categorías
                                foreach ($allCourses as $course){
                                    if($course->getIdCurso() == $_SESSION['student']->getCurso_fk()){
                                        echo "<option value='".$course->getIdCurso()."'>" .$course->getNombre(). "</option>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <!--Elegir que alumnos lo van a jugar-->
                        
                        <div class="col-xs-3 col-sm-3 players" style="display: none">
                            <select name="players[]" class="form-control selectpicker" title="Elegir alumnos" multiple data-max-options="64">
                                <?php
                                foreach ($allStudents as $stud){
                                    if($stud->getCurso_fk() == $_SESSION['student']->getCurso_fk()){
                                        echo '<option value="' .$stud->getIdAlumno().",".$stud->getNombre(). '">'.$stud->getNombre(). '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3" id="playersList" style="max-width: 300px;">

                        </div>
                    </div>
                    <div class="stage">

                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <h3>Paso 3: Especificaciones</h3>

                        <!--Elegir una fecha para el torneo-->
                        
                        <div class="col-xs-3 col-sm-3">
                            <div class='input-group date'>
                                <input type='text' placeholder="Elige fecha" id='myDate' value="" name="selDate" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>    
                    </div>

                    <!--Añadir un comentario para los alumnos-->  
                    
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-6">
                            <textarea class="form-control" rows="5" name="comment" id="comment" placeholder="Añadir comentario para los alumnos (opcional)"></textarea>
                        </div>
                    </div>
                    <div class="stage">

                    </div>

                    <!--Crear el torneo-->

                    <div class="row">
                        <div class="col-xs-5">
                                <input type="button" class="btn btn-info" id="sendNewTourn" value="Crear torneo" name="sendNewTourn">
                                <input type="submit" value="Crear torneo" id="tournamentSubmit" name="tournamentSubmit" style="visibility: hidden">
                        </div>
                    </div>
            </form>
                </div>
        </div>        
        <?php
        }else{    
            $nombre = $_POST['nameTournament'];
            $arrDeporte = explode(",", $_POST['sportName']);
            $agrup = $_POST['gameType'];
            $clase = $_POST['players'];
            $fecha = date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $_POST['selDate'].'+9 hours')));
            $comentario = $_POST['comment'];
            
            if($agrup == 'Individual'){
                $teamA = false;
                $teamB = false;
                $clase = generateTeams($clase, TRUE);
            }else{
                $teams = generateTeams($clase);
                $teamA = $teams[0];
                $teamB = $teams[1];
            }
            // Inserción a la base de datos
            $createTournamentRes = createTournament($nombre, $agrup, $clase, $arrDeporte, $fecha, $comentario, $teamA, $teamB, $clase);
        ?>
        <div class="container-fluid paddAll">
           <div class="col-md-offset-4 col-md-4 text-center">
                    <div class="panel panel-info panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <h4><?php echo $nombre; ?></h4>
                        </div>
                        <div class="panel-body text-center">
                            <p><strong><?php echo $arrDeporte[1]; ?></strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <?php
                            echo "<li class='list-group-item'>Modo de juego: <b>".$agrup."</b></li>";
                            echo "<li class='list-group-item'>Fecha: <b>".$fecha."</b></li>";
                            if($agrup != 'Individual'){
                                echo "<li class='list-group-item'>Equipo 1: ";
                                $namesA = "";
                                foreach($teamA as $a){
                                    $namesA .= $a.", ";
                                }
                                echo substr($namesA, 0, strlen($namesA)-2);
                                echo "</li>";
                                $namesB = "";
                                echo "<li class='list-group-item'>Equipo 2: ";
                                foreach($teamB as $b){
                                    $namesB.= $b.", ";
                                }
                                echo substr($namesB, 0, strlen($namesB)-2);
                            }else{
                                echo "<li class='list-group-item'>Jugadores: ";
                                $names = "";
                                foreach($clase as $c){
                                    $names.=$c.", ";
                                }
                                echo substr($names, 0, strlen($names)-2);
                            }
                            echo "</li>";
                            echo "<li class='list-group-item'>Comentario: <b>".$comentario."</b></li>";
                            ?>
                        </ul>
                        <div class="panel-footer">
                            <span><?php echo $createTournamentRes ?></span>
                        </div>
                    </div>
                </div> 
        </div>
        
        <?php
        }
        //FOOTER
        include_once(INCLUDES . DS . 'main_footer.php');
        ?>            
    </body>
</html>



