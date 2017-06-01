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
if(!isset($_SESSION['student'])){
?>
<div class="container-fluid paddAll">
    <h3>Jugadores de 1 ESO</h3>
    <table class="table" id="table1ESO">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($studs1ESO as $e1){
                echo "<tr><td>".$e1->getNombre()."</td>";
                echo "<td>".$e1->getUsuario_fk()."</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php
}else{
    ?>
    <div class="container-fluid paddAll">
    <h3>Jugadores de 1 ESO</h3>
    <table class="table" id="table1ESO">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Usuario</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($studs1ESO as $e1){
                echo "<tr><td>".$e1->getNombre()."</td>";
                echo "<td>".$e1->getApellido()."</td>";
                echo "<td>".$e1->getUsuario_fk()."</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<?php
}
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>
</body>
</html>