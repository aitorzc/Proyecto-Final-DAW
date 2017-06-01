<?php

if(isset($_GET['teamsSel'])){
    $values = json_decode(filter_input(INPUT_GET, 'teamsSel'), true);
    return insertTournRes($values);
}

if(isset($_GET['indTeams'])){
    $values = json_decode(filter_input(INPUT_GET, 'indTeams'), true);
    
    insertTournRes($values);
    
    echo "time before:".date("H:i:s").PHP_EOL;
    
    $newRounds = createNewRounds($values);
    
    echo "time AFTER:".date("H:i:s").PHP_EOL;
    
    
    return $newRounds;
}
if(isset($_GET['addStud'])){
    $values = json_decode(filter_input(INPUT_GET, 'addStud'), TRUE);
    return addUser($values);
}
if(isset($_GET['delStud'])){
    $value = json_decode(filter_input(INPUT_GET, 'delStud'), TRUE);
    $id = $value['id'];
    return delUser($id);
}
if(isset($_GET['changePermisUser'])){
    $value = json_decode(filter_input(INPUT_GET, 'changePermisUser'), TRUE);
    $id = $value['id'];
    return changePermisUser($id);
}

if(isset($_GET['saveStudentChanges'])){
    $values = json_decode(filter_input(INPUT_GET, 'saveStudentChanges'), TRUE);
    return updateStudent($values);
}   

if(isset($_GET['delTournament'])){
    $value = json_decode(filter_input(INPUT_GET, 'delTournament'), TRUE);
    $id = $value['id'];
    return deleteTournament($id);
}
if(isset($_GET['modifyTournament'])){
    $values = json_decode(filter_input(INPUT_GET, 'modifyTournament'), TRUE);
    return modifyTournament($values);
}
if(isset($_GET['checkMyPswd'])){
    $pass = $_SESSION['user']->getPassword();
    echo $pass;
}
if(isset($_GET['changePswd'])){
    $value = json_decode(filter_input(INPUT_GET, 'changePswd'), TRUE);
    return changePassword($_SESSION['user']->getLogin(), $value);
}

if(isset($_GET['sendMail'])){
    echo "entra";
    $values = json_decode(filter_input(INPUT_GET, 'changePswd'), TRUE);
    print_r($values);
    return sendMail($values['subject'], $values['message'], $values['headers']);
}