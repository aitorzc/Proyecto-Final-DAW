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
    


</div>

<script src="view/main/main.js"></script>

</body>
</html>