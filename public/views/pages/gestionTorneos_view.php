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
    <div class="panel panel-info">
        <div class="panel-heading">Gestión de torneos
        </div>
        <div class="panel-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Deporte</th>
                        <th>Participantes</th>
                        <th>Fecha</th>
                        <th>Comentario</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $actualDate = date('Y-m-d H:i:s');
                    $tourns = new Tournament();
                    //Este query selecciona los torneos sin claves duplicadas en los que aun no se haya celebrado ninguna ronda por lo que el IdGanador en la tabla ronda estara en NULL
                    $allTournsByDate = $tourns->selectClean("SELECT DISTINCT A.* FROM torneo A INNER JOIN ronda B ON A.IdTorneo = B.IdTorneo_fk WHERE B.IdGanador_fk IS NULL ORDER BY A.Fecha ASC");
                    
                    foreach ($allTournsByDate as $key => $value) {
                        $comentario = strlen($value->getComentario())>=20?substr($value->getComentario(), 0, 20)."...":$value->getComentario();
                        echo "<tr>";
                        echo "<td class='text-left'>".$value->getIdTorneo()."</td>";
                        echo "<td class='text-left'>".$value->getNombre()."</td>";
                        foreach($allSports as $sport){
                            if($sport->getId() == $value->getIdDeporte_fk()){
                                echo "<td class='text-left'>".$sport->getNombre()."</td>";
                            }
                        }
                        echo "<td class='text-left'>".$value->getNumParticipantes()."</td>";
                        echo "<td class='text-left'>".$value->getFecha()."</td>";
                        echo "<td class='text-left'>".$comentario."</td>";
                        
                        if($value->getFecha() > $actualDate){
                            echo "<td><button class='btn btn-success btn-xs prevTourn'><span class='glyphicon glyphicon-play'></span></button></td>";
                        }else{
                            echo "<td><button class='btn btn-danger btn-xs lateTourn'><span class='glyphicon glyphicon-play'></span></button></td>";
                        }
                        echo "<td><button class='btn btn-primary btn-xs editTourn'><span class='glyphicon glyphicon-pencil'></span></button></td>";
                        echo "<td><button class='btn btn-danger btn-xs deleteTourn'><span class='glyphicon glyphicon-trash'></span></button></td>";
                        echo "</tr>";
                    }
    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>    
</body>
</html>
