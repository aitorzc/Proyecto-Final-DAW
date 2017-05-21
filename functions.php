<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE LOGIN
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function checkLogin($userLog, $pswdLog){

    $user = new User();
    $selectValsUser = array("*");
    $whereUser = "Login = '{$userLog}' AND Password = '{$pswdLog}'";
    $result = $user->selectWhere($selectValsUser, $whereUser);
    
    if(empty($result[0])){
        return false;
    }else{
        $_SESSION['user'] = $result[0];
        $student = new Student();
        $selectValsStud = array("*");
        $log = $_SESSION['user']->getLogin();
        $whereStud = "Usuario_fk = '{$log}'";
        $result = $student->selectWhere($selectValsStud, $whereStud);
        $_SESSION['student'] = $result[0];
        return true;
    }
}    

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE NUEVO TORNEO
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function generateTeams(array $studentsVals, $individual = FALSE){
    $students = array();
    foreach ($studentsVals as $studs){
        $arr = explode(",", $studs);
        $students[$arr[0]] = $arr[1]; 
    }
    $studentsShuffled = shuffle_assoc($students);
    if($individual === TRUE){
        return $studentsShuffled;
    }
    $size = count($studentsShuffled)/2;
    return array_chunk($studentsShuffled, $size, true);
}

function returnName(){
    $defaultNames = array('Alpha','Beta','Gamma','Delta','Epsilon','Digamma','Stigma','Zeta','Heta','Eta','Theta','Iota','Yot','Kappa','Lamda','Mu','Nu','Xi','Omicron','Pi','San','Koppa','Rho','Sigma','Tau','Upsilon','Phi','Chi','Psi','Omega','Sampi','Sho');
    shuffle($defaultNames);
    return $defaultNames[0];
}

function createTournament($nombre, $clase, $arrDeporte, $fecha, $comentario, $teamA, $teamB, $clase){
    $idDeporte = $arrDeporte[0];
    $deporte = $arrDeporte[1];
    
    //Creat torneo a table torneo
    $torneo = new Tournament();
    //Nueva transacción a la DB
    $torneo->beginTransaction();

    $torneo->setNombre($nombre);
    $torneo->setIdDeporte_fk($idDeporte);
    $torneo->setNumParticipantes(count($clase));
    $torneo->setFecha($fecha);
    $torneo->setComentario($comentario);
    $idTorneo = $torneo->save();
    $torneo->setIdTorneo($idTorneo);
    
    if($teamA && $teamB){
        generateTwoTeams($idTorneo, $teamA, $teamB);
    }
    else{
        echo "entra si";
        generateIndividualTeams($idTorneo, $clase);
    }
    
    if($torneo->finishTransaction()){
        return $createTournamentRes = "Torneo creado correctamente.";
    }else{
        return $createTournamentRes = "Ha habido un error inseperado, vuelve a crear el torneo por favor.";
    }
}

function generateTwoTeams($idTorneo, $teamA, $teamB){
    //Crear equipos tabla equipo
    $equipoA = new Team();
    $equipoA->setNombre(returnName());
    $equipoA->setIdTorneo_fk($idTorneo);
    $idEquipoA = $equipoA->save();
    $equipoA->setIdEquipo($idEquipoA);

    $equipoB = new Team();
    $equipoB->setNombre(returnName());
    $equipoB->setIdTorneo_fk($idTorneo);
    $idEquipoB = $equipoB->save();
    $equipoB->setIdEquipo($idEquipoB);
    
    //Crear rondas tabla ronda y relacion equipo/ronda tabla equipo_ronda
    for($i = 1; $i <= 5; $i++){
        $ronda = new Round();
        $ronda->setIdTorneo_fk($idTorneo);
        $ronda->setRonda($i);
        $IdRonda_fk = $ronda->save();
        $ronda->setIdRonda($IdRonda_fk);

        $equipo_ronda1 = new Team_round();
        $equipo_ronda1->setIdEquipo_fk($idEquipoA);
        $equipo_ronda1->setIdRonda_fk($IdRonda_fk);
        $equipo_ronda1->save();

        $equipo_ronda2 = new Team_round();
        $equipo_ronda2->setIdEquipo_fk($idEquipoB);
        $equipo_ronda2->setIdRonda_fk($IdRonda_fk);
        $equipo_ronda2->save();
    }

    //Crear relaciones equipo-alumno table equipo_alumno
    foreach($teamA as $idA => $aVal){
        $equipo_alumno = new Team_student();
        $equipo_alumno->setIdEquipo_fk($equipoA->getIdEquipo());
        $equipo_alumno->setIdAlumno_fk($idA);
        $equipo_alumno->save();
    }

    foreach($teamB as $idB => $bVal){
        $equipo_alumno = new Team_student();
        $equipo_alumno->setIdEquipo_fk($equipoB->getIdEquipo());
        $equipo_alumno->setIdAlumno_fk($idB);
        $equipo_alumno->save();
    }
}

function generateIndividualTeams($idTorneo, $clase){
    $equipos = array();
    $defaultNames = array('Alpha','Beta','Gamma','Delta','Epsilon','Digamma','Stigma','Zeta','Heta','Eta','Theta','Iota','Yot','Kappa','Lamda','Mu','Nu','Xi','Omicron','Pi','San','Koppa','Rho','Sigma','Tau','Upsilon','Phi','Chi','Psi','Omega','Sampi','Sho');
    $i = 0;
    foreach($clase as $id => $nombre){
        $equipo = new Team();
        $equipo->setNombre($nombre."-".$defaultNames[$i]);
        $equipo->setIdTorneo_fk($idTorneo);
        $idEquipo = $equipo->save();
        $equipo->setIdEquipo($idEquipo);

        $equipo_alumno = new Team_student();
        $equipo_alumno->setIdEquipo_fk($idEquipo);
        $equipo_alumno->setIdAlumno_fk($id);
        $equipo_alumno->save(); 
        array_push($equipos, $equipo);
        $i++;
    }
    
    $nRounds = count($equipos);
    $j=0;
    for($k = 0; $k < $nRounds; $k+=2){
        
        $ronda = new Round();
        $ronda->setIdTorneo_fk($idTorneo);
        $ronda->setRonda($j+1);
        $IdRonda_fk = $ronda->save();
        $ronda->setIdRonda($IdRonda_fk);

        $equipo_ronda1 = new Team_round();
        $equipo_ronda1->setIdEquipo_fk($equipos[$k]->getIdEquipo());
        $equipo_ronda1->setIdRonda_fk($IdRonda_fk);
        $equipo_ronda1->save();
        
        $equipo_ronda2 = new Team_round();
        $equipo_ronda2->setIdEquipo_fk($equipos[$k+1]->getIdEquipo());
        $equipo_ronda2->setIdRonda_fk($IdRonda_fk);
        $equipo_ronda2->save();
        $j++;
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE GESTIONAR TORNEOS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function deleteTournament($id){
    $delTourn = new Tournament();
    $delTourn->deleteWhere('IdTorneo = '.$id);
}

function startTournament($id){
    $startTorneo = new Tournament();
    $tourn = $startTorneo->selectAdd("*", "WHERE IdTorneo = {$id}");
    
    $equipoRonda = new Team_round();
    
    $res = $equipoRonda->selectClean("SELECT B.IdRonda, B.Ronda,GROUP_CONCAT(c.IdEquipo, '~', c.Nombre, ' ') AS Equipo FROM equipo_ronda A INNER JOIN ronda B ON A.IdRonda_fk = B.IdRonda INNER JOIN equipo C ON C.IdEquipo = A.IdEquipo_fk WHERE B.IdTorneo_fk = {$id} GROUP BY B.IdRonda ORDER BY B.Ronda");
    $insertResults = "<h3 class='text-center'>{$tourn[0]->getNombre()}</h3><h4>Seleccionar equipo ganador en cada ronda</h4>";
    $insertResults.= "<table class='table resTable'>"
                        . "<thead>"
                            . "<tr>"
                                . "<th>Ronda</th>"
                                . "<th>Equipo 1</th>"
                                . "<th>Equipo 2</th>"
                            . "</tr>"
                        . "</thead>"
                        . "<tbody>";
    foreach($res as $r){
        $teams = explode(" ,",  $r->Equipo);
        $teamA = explode("~", $teams[0]);
        $teamB = explode("~", $teams[1]);
        $insertResults.="<tr class='roundrow' roundid='".$r->IdRonda."'><td>".$r->Ronda."</td><td><button class='btnteam btn btn-primary teamA' idteam='".$teamA[0]."'>".$teamA[1]."</button></td><td><button class='btnteam btn btn-danger teamB' idteam='".$teamB[0]."'>".$teamB[1]."</buton></td></tr>";
    }
    $insertResults.= "</tbody></table>";
    return $insertResults;
}
function insertTournRes(array $values){
    $winners = array();
    foreach($values as $v){
        $round = $v['round'];
        $team = $v['teamid'];
//        if(array_key_exists($team, $winners)){
//            $winners[$team]++;
//        }else{
//            $winners[$team] = 1;
//        }
        $changes = array("IdGanador_fk" => $team);
        $roundW = new Round();
        $roundW->updateRow($changes, "IdRonda = {$round}");
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE AYUDA
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function echopre($expression){
    echo "<pre>".print_r($expression, true)."</pre>";
}
//Shuffle array manteniendo su key
function shuffle_assoc($list) { 
  $keys = array_keys($list); 
  shuffle($keys); 
  $random = array(); 
  foreach ($keys as $key) { 
    $random[$key] = $list[$key]; 
  }
  return $random; 
} 

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE PEFIL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function verPermiso(){
    $value = $_SESSION['student']->getPermiso();
    if($value){
        echo "<td style='color:green'>¡Puedes participar en torneos!</td>";
    }else{
        echo "<td style='color:red'>No puedes participar en los torneos.</td>";
    }
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE SANEAMIENTO
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function cleanInput($value, $type){
    
    $result = trim($value);
    
    switch ($type) {
        case 'name':
            $filter = FILTER_SANITIZE_STRING;
            break;
        case 'email':
            $filter = FILTER_SANITIZE_EMAIL;
            break;
        case 'number':
            $filter = FILTER_SANITIZE_NUMBER_INT;
            break;
        default:
            $filter = FILTER_SANITIZE_STRING;
            break;
    }
    $result = filter_var($result, FILTER_SANITIZE_MAGIC_QUOTES);
    $result = filter_var($value, $type);
    
    return $result;
    
}//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE GESTIONAR ALUMNOS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function addUser(array $values){
    $usu = new User();
    $usu->setLogin($values['Login']);
    $usu->setPassword($values['Password']);
    $usu->setAvatar($values['Avatar']);
    $usu->setRango_fk($values['Rango_fk']);
    $usu->save();
    
    $stud = new Student();
    $stud->setNombre($values['Nombre']);
    $stud->setApellido($values['Apellido']);
    $stud->setEmail($values['Email']);
    $stud->setPermiso($values['Permiso']);
    $stud->setCurso_fk($values['Curso']);
    $stud->setUsuario_fk($values['Usuario']);
    $stud->save();
}
function delUser($id){
    $delUser = new Student();
    $delUser->deleteWhere('IdAlumno = '.$id.'');
}
function changePermisUser($id){
    $stud = new Student();
    $data = 'Permiso = case WHEN Permiso = 1 THEN 0 ELSE 1 END WHERE IdAlumno = '.$id.'';
    $stud->updateCleanRow($data);
}