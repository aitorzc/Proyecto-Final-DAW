<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="view/main/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>VidsToFind</title>
</head>
<body>

<nav class="navbar navbar-inverse">   
    <div class="container-fluid">
        <ul class="nav navbar-nav">       
            <li><a onmouseover="rightIconMenu(this)" id="btnMenu" onclick="openSidenav()"><span class="glyphicon glyphicon-menu-hamburger"></span> Menú</a></li>
            <li class="active"><a href="#">Home</a></li>
            <li><a href="#">Tal</a></li>
            <li><a href="#">Ytal</a></li>
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
            <li><a href="#"><span class="glyphicon glyphicon-user"></span> Regístrate</a></li>
            <li><a href="view/register"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
        </ul>
    </div>    
</nav>
<div id="sidenav" class="sidenav">
    <nav>
        <ul class="sidebar-nav nav list-group">
            <li class="list-group-item">Categorías</li>
            <?php
                // Lista de categorías
                for ($i = 0; $i < count($matrizCategorias); $i++) {

                    echo "<a href='#' class='list-group-item'>" . $matrizCategorias[$i]->getNombre() . "</a>";

                }
            ?>
        </ul>
    </nav>
  
</div>
<div class="container">
    <h1>Prueba</h1>
    <p>Hola.</p>
</div>

<script src="view/main/main.js"></script>

</body>
</html>