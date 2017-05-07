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
        if(!isset($_GET['crearTorneo'])){
        ?>
        <div class="container-fluid paddAll">
            <h2 class="text-center">Nuevo torneo</h2>
            <form action="?page=nuevo_torneo&crearTorneo=true" method="POST">
                <div class="row">
                    <div class="form-group ">
                        <h3>Paso 1: ¿Qué vamos a jugar?</h3>

                        <!--Elegir deporte para el torneo-->
                        
                        <div class="col-xs-3 col-sm-3">
                            <select name="sportName" class="form-control selectpicker">
                                <option value="0" disabled selected hidden>Elige deporte</option>
                                <?php
                                // Lista de deportes
                                foreach ($allSports as $sport) {
                                    echo "<option value='".$sport->getNombre()."'>" . $sport->getNombre() . "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!--Elegir el modo de juego para el torneo-->
                        
                        <div class="col-xs-3 col-sm-3"> 
                            <select name="gameMode" class="form-control selectpicker">
                                <option value="0" disabled selected hidden>Elige tipo de torneo</option>
                                <?php
                                // Lista de categorías
                                foreach ($allCategs as $category) {
                                    echo "<option value='".$category->getNombre()."'>" .$category->getNombre(). "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!--Elegir el modo de agrupación de jugadores (individual, por equipos)-->
                        
                        <div class="col-xs-3 col-sm-3">
                            <select name="gameType" class="form-control selectpicker">
                                <option value="0" disabled selected hidden>Elige tipo de agrupación</option>
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

                        <!--Elegir que curso juega-->
                        
                        <div class="col-xs-3 col-sm-3">
                            <select name="userCourse" id="elegirCurso" class="form-control selectpicker">
                                <option value="0" disabled selected hidden>Elige curso</option>
                                <?php
                                // Lista de categorías
                                foreach ($allCourses as $course) {
                                    echo "<option value='".$course->getIdCurso()."'>" .$course->getNombre(). "</option>";
                                }
                                ?>
                            </select>
                        </div>

                        <!--Elegir que alumnos lo van a jugar-->
                        
                        <div class="col-xs-3 col-sm-3 players" style="display: none">
                            <select name="players[]" class="form-control selectpicker" title="Elegir alumnos" multiple data-max-options="24">
                                <?php
                                foreach ($allStudents as $stud){
                                    if($stud->getCurso_fk() == 1){
                                        echo '<option value="' .$stud->getNombre(). '">'.$stud->getNombre(). '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3 players" style="display: none">
                            <select name="players[]" class="form-control selectpicker" title="Elegir alumnos" multiple data-max-options="24">
                                <?php
                                foreach ($allStudents as $stud){
                                    if($stud->getCurso_fk() == 2){
                                        echo '<option value="' .$stud->getNombre() . '">' .$stud->getNombre(). '</option>';
                                    }
                                }
                                ?>
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3 players" style="display: none">
                            <select name="players[]" class="form-control selectpicker" title="Elegir alumnos" multiple data-max-options="24">
                                <?php
                                foreach ($allStudents as $stud){
                                    if($stud->getCurso_fk() == 3){
                                        echo '<option value="' .$stud->getNombre() . '">' .$stud->getNombre(). '</option>';
                                    }
                                }
                                ?>
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3 players" style="display: none">
                            <select name="players[]" class="players" class="form-control selectpicker" title="Elegir alumnos" multiple data-max-options="24">
                                <?php
                                foreach ($allStudents as $stud){
                                    if($stud->getCurso_fk() == 4){
                                        echo '<option value="' .$stud->getNombre(). '">' .$stud->getNombre(). '</option>';
                                    }
                                }
                                ?>
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
                                <input type="submit" value="send" id="tournamentSubmit" name="tournamentSubmit" style="visibility: hidden">
                        </div>
                    </div>
            </form>
                </div>
        </div>        
        <?php
        }else{    
            $deporte = $_POST['sportName'];
            $tipo = $_POST['gameMode'];
            $agrup = $_POST['gameType'];
            $clase = $_POST['players'];
            $fecha = $_POST['selDate'];
            $comentario = $_POST['comment'];
            
            
            if($agrup == 'Individial'){
                
            }else{
                $teams = generateTeams($clase);
                $teamA = $teams[0];
                $teamB = $teams[1];
                echo "Equipo 1: ";
                foreach($teamA as $a){
                    echo $a."-";
                }
                echo "<br>Equipo 2: ";
                foreach($teamB as $b){
                    echo $b."-";
                }
            }
            echo "<br>Fecha: ".$fecha."<br>";
            echo "Comentario: ".$comentario."<br>";
        ?>
        <div class="col-md-4 text-center">
                    <div class="panel panel-info panel-pricing">
                        <div class="panel-heading">
                            <i class="fa fa-desktop"></i>
                            <input type="text" placeholder="Nombre torneo..." name="nameTournament">
                        </div>
                        <div class="panel-body text-center">
                            <p><strong></strong></p>
                        </div>
                        <ul class="list-group text-center">
                            <?php
                            echo "<li class='list-group-item'>Deporte: ".$deporte."</li>";
                            echo "<li class='list-group-item'>Modo de juego: ".$tipo." ".$agrup."</li>";
                            ?>
                            <li class='list-group-item'></li>
                            <li class="list-group-item"></li>
                            <li class="list-group-item"></li>
                        </ul>
                        <div class="panel-footer">
                            <a class="btn btn-lg btn-block btn-primary" href="#">Crear torneo</a>
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



