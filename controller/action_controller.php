<?php

if(isset($_GET['teamsSel'])){
    $values = json_decode(filter_input(INPUT_GET, 'teamsSel'), true);
    return insertTournRes($values);
}
if(isset($_GET['delStud'])){
    $value = json_decode(filter_input(INPUT_GET, 'delStud'));
    $id = $value->id;
    return delUser($id);
}
if(isset($_GET['changePermisUser'])){
    $value = json_decode(filter_input(INPUT_GET, 'changePermisUser'));
    $id = $value->id;
    changePermisUser($id);
}

    
    