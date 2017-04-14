<nav class="navbar">   
    <div class="container-fluid">
        <ul class="nav navbar-nav">       
            <li><a id="btnMenu" onclick="openSidenav()"><span class="glyphicon glyphicon-menu-hamburger"></span> Categorías</a></li>
            <li class="active"><a href="#">Inicio</a></li>
            <li><a href="tournament_history">Historial de Torneos</a></li>
            <li><a href="new_tournament">Nuevo torneo</a></li>
            <li><p class="navbar-text">Bienvenido <?php echo $nombre ?></p></li>
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
            <li><a href="view/register"><span class="glyphicon glyphicon-log-out"></span> Salir</a></li>
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
                foreach($allSports as $sport){
                    echo "<a href='#'>".$sport->Nombre."</a>";
                }
            ?>
        </ul>
    </nav>
  
</div>

