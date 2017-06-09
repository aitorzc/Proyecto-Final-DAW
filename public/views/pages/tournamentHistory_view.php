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
    <table id="historyTable" class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Deporte</th>
                <th>Modo</th>
                <th>Participantes</th>
                <th>Fecha</th>
                <th>Comentario</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            foreach($allTournsByDate as $key => $value){
                $comentario = strlen($value->getComentario())>=20?substr($value->getComentario(), 0, 20)."...":$value->getComentario();
                echo "<tr>";
                echo "<td class='text-left'>".$value->getNombre()."</td>";
                foreach($allSports as $sport){
                    if($sport->getId() == $value->getIdDeporte_fk()){
                        echo "<td class='text-left'>".$sport->getNombre()."</td>";
                    }
                }
                echo "<td class='text-left'>".$value->getModo()."</td>";
                echo "<td class='text-left'>".$value->getNumParticipantes()."</td>";
                echo "<td class='text-left'>".$value->getFecha()."</td>";
                echo "<td class='text-left'>".$comentario."</td>";
                if(isset($_SESSION['student'])){
                    echo "<td><a href='index.php?page=results&showResults=".$value->getIdTorneo()."'>Ver</a></td>";
                }else{
                    echo "<td> - </td>";
                }
                echo "</tr>";
            }
            ?>
        </tbody>
    </table> 
   
    
</div>
<?php
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>
</body>
</html>