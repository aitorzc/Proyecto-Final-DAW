<?php
if(!isset($_SESSION['user'])){
//Header para usuarios no logueados
?>
<nav class="navbar">
    <div class="container-fluid" id="colNav">
        <div class="navbar-header">
            <a class="navbar-brand" href="?page=inicio">Torneos extraescolares</a>
        </div>
        <ul class="nav navbar-nav">
            <li class="active"><a href="?page=inicio">Inicio</a></li>
            <li class="dropdown">
                <a data-toggle="dropdown">Categorías <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">Cursos</li>
                    <li><a href='?page=1ESO'> 1r ESO </a></li>
                    <li><a href='?page=2ESO'> 2n ESO </a></li>
                    <li><a href='?page=3ESO'> 3r ESO </a></li>
                    <li><a href='?page=4ESO'> 4rt ESO </a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Deportes</li>
                    <?php
                    foreach($allSports as $sport){                     
                        echo "<li><a href='?page=infoSports'>".($sport->getNombre())."</a></li>";
                    }
                    ?>
                </ul>
            </li>
            <li><a href="?page=historial_torneos">Historial de Torneos</a></li>
            <li><a href="?page=contacto">Información y Contacto</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="?page=registro"><span class="glyphicon glyphicon-user"></span> Entra/Regístrate</a></li>
        </ul> 
    </div>    
</nav>
<?php
}else{
//Header para usuarios logueados
?>    
    <nav class="navbar">   
        <div class="container-fluid myBar">
            <ul class="nav navbar-nav"> 
                <div class="navbar-header">
          <a class="navbar-brand" href="?page=inicio">Torneos extraescolares</a>
        </div>
            <li class="active"><a href="?page=inicio">Inicio</a></li>
            <li class="dropdown">
                <a data-toggle="dropdown">Categorías <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">Cursos</li>
                    <li><a href='?page=1ESO'> 1r ESO </a></li>
                    <li><a href='?page=2ESO'> 2n ESO </a></li>
                    <li><a href='?page=3ESO'> 3r ESO </a></li>
                    <li><a href='?page=4ESO'> 4rt ESO </a></li>
                    <li class="divider"></li>
                    <li class="dropdown-header">Deportes</li>
                    <?php
                    foreach($allSports as $sport){                     
                        echo "<li><a href='?page=infoSports'>".($sport->getNombre())."</a></li>";
                    }
                    ?>
                </ul>
            </li>
            <li><a href="?page=historial_torneos">Historial de Torneos</a></li>
            <li><a href="?page=contacto">Información y Contacto</a></li>
            <?php
                if($_SESSION['user']->getRango_fk() == 2){
                    echo '<li><a href="?page=nuevo_torneo">Nuevo torneo</a></li>';
                    echo '<li><a href="?page=gestion_torneos">Gestionar torneos</a></li>';
                }
            ?>        
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li>
                <button id="profile" class="btn btn-info dropdown-toggle" type="button" data-toggle="dropdown">
                    <?php echo "Hola, ".$_SESSION['student']->getNombre()." ".$_SESSION['student']->getApellido(); ?>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                    <li class="dropdown-header">Acciones</li>
                    <li><a href="?page=mi_perfil">Mi perfil</a></li>
                    <li><a href="?page=mi_clase">Mi clase</a></li>
                    <li class="divider"></li>
                    <li><a href="?page=out">Salir</a></li>
                </ul>
            </li>
        </ul>
    </div>    
</nav>
<?php
}
