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
    <div class="col-md-offset-2 col-md-8 text-left">
        <h3 class="text-center">Información</h3>
        <p>El Instituto Ies Sonferrer es una institución pública para promover la enseñanza, y el estudio. En sus actividades se incluye
            la práctica de deportes en grupo con el objetivo de fomentar la actividad deportiva.
        </p>
        <p>
            Para incentivar toda la participación posible de los alumnos realizamos varios eventos deportivos, las clasificaciones y información sobre éstos
            se puede encontrar en esta página que además fomenta la competitividad entre alumnos.
        </p>
        <p>
            Estos eventos siempre estarán regulados por un profesor como mínimo y los deportes se llevarán a cabo con sus respectivas normas, si se 
            considera que un alumno incumple las normas o fomenta el mal juego o violencia será inmediatamente expulsado del evento, si esto ocurre en más de 
            un evento el alumno no volverá a poder particiar en más eventos.
        </p>
    </div>    
</div>    
    
<div class="container-fluid paddAll">
    <h3 class="text-center">Contáctanos</h3>
    
    <form class="form-horizontal" action="" method="post">
        <!-- Title-->
        <div class="form-group">
            <div class="col-md-12">
                <h4><kbd>Envíanos un mensaje</kbd></h4>
            </div>
        </div>
        <!-- Name input-->
        <div class="form-group">
            <label class="col-md-3 control-label" for="name">Nombre</label>
            <div class="col-md-6">
                <input id="name" name="name" type="text" placeholder="Tu nombre" class="form-control">
            </div>
        </div>

        <!-- Email input-->
        <div class="form-group">
            <label class="col-md-3 control-label" for="email">E-mail</label>
            <div class="col-md-6">
                <input id="email" name="email" type="text" placeholder="Tu email" class="form-control">
            </div>
        </div>

        <!-- Message body -->
        <div class="form-group">
            <label class="col-md-3 control-label" for="message">Mensaje</label>
            <div class="col-md-6">
                <textarea class="form-control" id="message" name="message" placeholder="Introduzca su mensaje aquí..." rows="5"></textarea>
            </div>
        </div>

        <!-- Form actions -->
        <div class="form-group">
            <div class="col-md-1">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
            </div>
        </div>
    </form>
    
    <h4><kbd>Ubicación Google Maps</kbd></h4>
    <div id="googleMap" style="width:100%;height:400px;"></div>
    <script>
    function myMap() {
        var myCenter = new google.maps.LatLng(39.498063,2.503489);
        var mapCanvas = document.getElementById("googleMap");
        var mapOptions = {center: myCenter, zoom: 15};
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({position:myCenter});
        marker.setMap(map);
    }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAmCn3Ts7WjYWdBB1erSuqe-GPixK0_ZMI&callback=myMap"></script>
</div>    
<?php
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>   
</body>
</html>