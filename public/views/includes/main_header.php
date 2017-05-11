<?php
if(!isset($_SESSION['user'])){
//Header para usuarios no logueados
?>
<nav class="navbar">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#colNav">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <!--<a class="navbar-brand" href="#">Nombre web</a>-->
    </div>
    <div class="container-fluid collapse navbar-collapse" id="colNav">
        <ul class="nav navbar-nav">       
            <li><a id="btnMenu"><span class="glyphicon glyphicon-menu-hamburger"></span> Categorías</a></li>
        </ul>
        <ul class="nav navbar-nav">
            <li class="active"><a href="?page=inicio">Inicio</a></li>
            <li><a href="?page=historial_torneos">Historial de Torneos</a></li>
            <li><a href="?page=contacto">Información y Contacto</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="?page=registro"><span class="glyphicon glyphicon-user"></span> Entra/Regístrate</a></li>
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
                    echo "<a href='#'>".($sport->getNombre())."</a>";
                }
            ?>
        </ul>
    </nav>
  
</div>
<?php
}else{
//Header para usuarios logueados
?>    
    <nav class="navbar">   
    <div class="container-fluid myBar">
        <ul class="nav navbar-nav">       
            <li><a id="btnMenu" onclick="openSidenav()"><span class="glyphicon glyphicon-menu-hamburger"></span> Categorías</a></li>
            <li class="active"><a href="?page=inicio">Inicio</a></li>
            <li><a href="?page=historial_torneos">Historial de Torneos</a></li>
            <li><a href="?page=gestion_torneos">Gestionar torneos</a></li>
            <?php
                if($_SESSION['user']->getRango_fk() == 2){
                    echo '<li><a href="?page=nuevo_torneo">Nuevo torneo</a></li>';
                }
            ?>        
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <button id="profile" class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">
                    <?php echo "Hola,    ".$_SESSION['student']->getNombre()." ".$_SESSION['student']->getApellido(); ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">Acciones</li>
                    <li><a href="?page=mi_perfil">Mi perfil</a></li>
                    <li><a href="?page=mi_clase">Mi clase</a></li>
                    <li><a href="?page=out">Salir</a></li>
                </ul>
            </li>
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
                    echo "<a href='#'>".$sport->getNombre()."</a>";
                }
            ?>
        </ul>
    </nav>
  
</div>
<?php
}
