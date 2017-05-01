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
        ?>
        <div class="container-fluid paddAll">
            <h2 class="text-center">Nuevo torneo</h2>
            <form action="?crearTorneo=true" method="POST">
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
                                    echo "<option value='$sport->Nombre'>" . $sport->Nombre . "</option>";
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
                                    echo "<option value='$category->Nombre'>" . $category->Nombre . "</option>";
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
                                <option value="1">1r ESO</option>
                                <option value="2">2n ESO</option>
                                <option value="3">3r ESO</option>
                                <option value="4">4rt ESO</option>
                            </select>
                        </div>

                        <!--Elegir que alumnos lo van a jugar-->
                        
                        <div class="col-xs-3 col-sm-3 players" style="display: none">
                            <select name="players" class="form-control selectpicker" title="Elegir alumnos" multiple data-max-options="24">
                                <?php
                                foreach ($alumnos1 as $als) {
                                    echo '<option value="' . $als . '">' . $als . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3 players" style="display: none">
                            <select name="players" class="form-control selectpicker" title="Elegir alumnos" multiple data-max-options="24">
                                <?php
                                foreach ($alumnos2 as $als) {
                                    echo '<option value="' . $als . '">' . $als . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3 players" style="display: none">
                            <select name="players" class="form-control selectpicker" title="Elegir alumnos" multiple data-max-options="24">
                                <?php
                                foreach ($alumnos3 as $als) {
                                    echo '<option value="' . $als . '">' . $als . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-3 col-sm-3 players" style="display: none">
                            <select name="players" class="players" class="form-control selectpicker" title="Elegir alumnos" multiple data-max-options="24">
                                <?php
                                foreach ($alumnos4 as $als) {
                                    echo '<option value="' . $als . '">' . $als . '</option>';
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
                                <input type='text' placeholder="Elige fecha" id='myDate' value="" class="form-control" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>    
                    </div>

                    <!--Añadir un comentario para los alumnos-->  
                    
                    <div class="form-group">
                        <div class="col-xs-6 col-sm-6">
                            <textarea class="form-control" rows="5" id="comment" placeholder="Añadir comentario para los alumnos (opcional)"></textarea>
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
        //FOOTER
        include_once(INCLUDES . DS . 'main_footer.php');
        ?>            
    </body>
</html>



