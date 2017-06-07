<?php
//Insertar resultados de torneo
if(isset($_GET['teamsSel'])){
    $values = json_decode(filter_input(INPUT_GET, 'teamsSel'), true);
    return insertTournRes($values);
}
//Crear rondas nuevas para torneo individual
if(isset($_GET['indTeams'])){
    $values = json_decode(filter_input(INPUT_GET, 'indTeams'), true);
    insertTournRes($values);
    $newRounds = createNewRounds($values);
    return $newRounds;
}
//Crear un estudiante y alumno
if(isset($_GET['addStud'])){
    $values = json_decode(filter_input(INPUT_GET, 'addStud'), TRUE);
    return addUser($values);
}
//Eliminar alumno y estudiante
if(isset($_GET['delStud'])){
    $value = json_decode(filter_input(INPUT_GET, 'delStud'), TRUE);
    $id = $value['id'];
    return delUser($id);
}
//Cambiar permiso de un alumno
if(isset($_GET['changePermisUser'])){
    $value = json_decode(filter_input(INPUT_GET, 'changePermisUser'), TRUE);
    $id = $value['id'];
    return changePermisUser($id);
}
//Guardar los cambios de datos de un alumno
if(isset($_GET['saveStudentChanges'])){
    $values = json_decode(filter_input(INPUT_GET, 'saveStudentChanges'), TRUE);
    return updateStudent($values);
}   
//Borrar un torneo
if(isset($_GET['delTournament'])){
    $value = json_decode(filter_input(INPUT_GET, 'delTournament'), TRUE);
    $id = $value['id'];
    return deleteTournament($id);
}
//Modificar un torneo
if(isset($_GET['modifyTournament'])){
    $values = json_decode(filter_input(INPUT_GET, 'modifyTournament'), TRUE);
    return modifyTournament($values);
}
//Comprobar contraseña
if(isset($_GET['checkMyPswd'])){
    $pass = $_SESSION['user']->getPassword();
    echo $pass;
}
//Cambiar contraseña
if(isset($_GET['changePswd'])){
    $value = json_decode(filter_input(INPUT_GET, 'changePswd'), TRUE);
    return changePassword($_SESSION['user']->getLogin(), $value);
}
//Enviar mail
if(isset($_GET['sendMail'])){
    $values = json_decode(filter_input(INPUT_GET, 'sendMail'), TRUE);
    return sendMail($values['subject'], $values['message'], $values['headers']);
}
//Eliminar deporte
if(isset($_GET['delSport'])){
    $value = json_decode(filter_input(INPUT_GET, 'delSport'), TRUE);
    $id = $value['id'];
    return deleteSport($id);
}