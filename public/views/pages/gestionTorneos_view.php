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
if(!isset($_GET['startTournament'])){
?>
<div class="container-fluid paddAll">
    <div class="panel panel-info">
        <div class="panel-heading">Gestión de torneos
        </div>
        <div class="panel-body">
            <table class="table" id="tableTournaments">
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
                            echo "<td><form class='playTourn' action='index.php?page=gestion_torneos&startTournament=".$value->getIdTorneo()."' method='POST' name='startTournForm'><span class='btn btn-success btn-xs prevTourn'><i class='glyphicon glyphicon-play'></i></span></form></td>";
                        }else{
                            echo "<td><form action='index.php?page=gestion_torneos&startTournament=".$value->getIdTorneo()."' method='POST' name='startTournForm'><span class='btn btn-danger btn-xs lateTourn'><span class='glyphicon glyphicon-play'></span></span></form></td>";
                        }
                        echo "<td><form action='index.php?page=gestion_torneos&editTournament=".$value->getIdTorneo()."' method='POST' name='editTournForm'><span class='btn btn-primary btn-xs editTourn'><span class='glyphicon glyphicon-pencil'></span></span></form></td>";
                        echo "<td><form action='index.php?page=gestion_torneos&delTournament=".$value->getIdTorneo()."' method='POST' name='delTournForm'><span class='btn btn-danger btn-xs deleteTourn'><span class='glyphicon glyphicon-trash'></span></span>";
                        echo "</form></td>";
                        echo "</tr>";
                    }
    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
}else{
    ?>
    <div class="container-fluid paddAll">
        <div class="panel panel-info">
            <div class="panel-heading">Torneo: 
            </div>
            <div class="panel-body">
                <?php
                echo $stringTourn;
                ?>
                <input type="button" id="sendResults" class="btn btn-success" value="Enviar">
            </div>
        </div>
    </div>        
    <?php
}
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>    
</body>
</html>
