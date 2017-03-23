<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/main/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Torneos</title>
</head>
<body>

<nav class="navbar">   
    <div class="container-fluid">
        <ul class="nav navbar-nav">       
            <li><a id="btnMenu" onclick="openSidenav()"><span class="glyphicon glyphicon-menu-hamburger"></span> Categorías</a></li>
            <li class="active"><a href="#">Inicio</a></li>
            <li><a href="#">Historial de Torneos</a></li>
            <li><a href="#">Información y Contacto</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <form class="navbar-form navbar-left">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
        </form>
            <li><a href="view/register"><span class="glyphicon glyphicon-user"></span> Entra/Regístrate</a></li>
        </ul>
    </div>    
</nav>
<div id="sidenav" class="sidenav">
    <nav>
        <ul class="sidebar-nav nav list-group">
            <li class="list-group-item">Cursos</li>
            <a href='#'> 1r ESO </a>
            <a href='#'> 2n ESO </a>
            <a href='#'> 3r ESO </a>
            <a href='#'> 4rt ESO </a>
            <li class="list-group-item">Deportes</li>
            <?php
                // Lista de deportes
                for ($i = 0; $i < count($matrizDeportes); $i++) {
                    echo "<a href='#'>" . $matrizDeportes[$i]->getNombre() . "</a>";
                }
            ?>
        </ul>
    </nav>
  
</div>
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
<script src="view/main/main.js"></script>

</body>
</html>