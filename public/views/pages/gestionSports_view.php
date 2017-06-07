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
        <div class="panel-heading">Gestión de deportes
        </div>
        <div class="panel-body">
            <table data-order='[[ 0, "asc" ]]' class="table" id="tableSports">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($allSports as $value){
                        echo "<tr>";
                        echo "<td for='".$value->getId()."' class='idSport'>".$value->getId()."</td>";
                        echo "<td for='".$value->getNombre()."' class='Nombre'>".$value->getNombre()."</td>";
                        echo "<td for='".$value->getDescripcion()."' class='Descripcion'>".$value->getDescripcion()."</td>";
                        echo "<td for='".$value->getImagen()."' class='Nombre'><img class='imgEdit' src='public/images/new_tournament/".$value->getImagen()."'></img></td>";
                        echo "<td><span for='".$value->getId()."' class='btn btn-primary btn-xs editSport'><span class='glyphicon glyphicon-pencil'></span></span></td>";
                        echo "<td><span for='".$value->getId()."' class='btn btn-danger btn-xs deleteSport'><span class='glyphicon glyphicon-trash'></span></span></td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <span id="addSport" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Crear deporte nuevo</span>
            <?php 
            if(isset($responseMessage)){
                echo "<p id='responseSport' >".$responseMessage."</p>";
            }
            ?>
    </div>
</div>   
<?php
//FOOTER
include_once(INCLUDES.DS.'main_footer.php'); 
?>    
    <div class="hidden">
        <form id="createSport" enctype="multipart/form-data" action="index.php?page=gestion_deportes&createSport=true" method="POST">
            <fieldset>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12 text-center">
                            <h3>Crear deporte</h3>
                        </div>
                        <div class='col-xs-12'>
                            <label>Nombre</label>
                            <div class="form-group">
                                <input type="text" class="hidden" value=""/>
                                <input type="text" class="form-control" name="createSportName" value=""/>
                            </div>
                        </div>
                        <div class='col-xs-12'>
                            <label>Descripción</label>
                            <div class="form-group">
                                <textarea class="col-xs-12 form-control" name="createSportDesc"></textarea>
                            </div>
                        </div>
                        <div class='col-xs-12  margin-bt'>
                            <label>Imagen</label>
                            <div class="form-group">
                                <img class='col-xs-offset-3 col-xs-6 imgEdit imgSport' id="imgSport" name="modifySportImg" src=''>
                                <label class="btn btn-default btn-info col-xs-offset-3 col-xs-6">
                                    Elige <input type="file" id="inpCreateFile" name="createImg" style="display: none;">
                                </label>
                            </div>
                        </div>
                        <legend></legend>
                        <div class='col-xs-12'>
                            <div class="form-group">
                                <span class="btn btn-primary col-xs-12" id="saveSport">Crear</span>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
        <form id="modifySport" enctype="multipart/form-data" action="index.php?page=gestion_deportes&modifySport=true" method="POST">
            <fieldset>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-12 text-center">
                            <h3>Modificar deporte</h3>
                        </div>
                        <div class='col-xs-12'>
                            <label>Nombre</label>
                            <div class="form-group">
                                <input type="text" name="idSport" class="hidden"/>
                                <input type="text" class="form-control" name="modifySportName" value=""/>
                            </div>
                        </div>
                        <div class='col-xs-12'>
                            <label>Descripción</label>
                            <div class="form-group">
                                <textarea class="col-xs-12 form-control" name="modifySportDesc"></textarea>
                            </div>
                        </div>
                        <div class='col-xs-12  margin-bt'>
                            <label>Imagen</label>
                            <div class="form-group">
                                <img class='col-xs-offset-3 col-xs-6 imgEdit imgSport' name="modifySportImg" id="imgSport" src=''>
                                <label class="btn btn-default btn-info col-xs-offset-3 col-xs-6">
                                    Elige <input type="file" id="inpModifyFile" name="modifyImg" style="display: none;">
                                </label>
                            </div>
                        </div>
                        <legend></legend>
                        <div class='col-xs-12'>
                            <div class="form-group">
                                <span class="btn btn-primary col-xs-12" id="saveSportChanges">Modificar deporte</span>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>    
</body>
</html>
