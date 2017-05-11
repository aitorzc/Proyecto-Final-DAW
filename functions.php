<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE LOGIN
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function checkLogin($userLog, $pswdLog){

    $user = new User();
    $selectValsUser = array("*");
    $whereUser = "Login = '{$userLog}' AND Password = '{$pswdLog}'";
    $result = $user->selectWhere($selectValsUser, $whereUser);
    $_SESSION['user'] = $result[0];
    
    if(empty($_SESSION['user'])){
        return false;
    }else{
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
function generateTeams(array $studentsVals){
    $students = array();
    foreach ($studentsVals as $studs){
        $arr = explode(",", $studs);
        $students[$arr[0]] = $arr[1]; 
    }
    $studentsShuffled = shuffle_assoc($students);
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
        //Crear equipos tabla equipo
        $equipoA = new Team();
        $equipoA->setNombre(returnName());
        $equipoA->setIdTorneo_fk($torneo->getIdTorneo());
        $idEquipoA = $equipoA->save();
        $equipoA->setIdEquipo($idEquipoA);

        $equipoB = new Team();
        $equipoB->setNombre(returnName());
        $equipoB->setIdTorneo_fk($torneo->getIdTorneo());
        $idEquipoB = $equipoB->save();
        $equipoB->setIdEquipo($idEquipoB);
    }
    else{
        $equipos = array();
        $i = 0;
        $defaultNames = array('Alpha','Beta','Gamma','Delta','Epsilon','Digamma','Stigma','Zeta','Heta','Eta','Theta','Iota','Yot','Kappa','Lamda','Mu','Nu','Xi','Omicron','Pi','San','Koppa','Rho','Sigma','Tau','Upsilon','Phi','Chi','Psi','Omega','Sampi','Sho');
        foreach($clase as $id => $nombre){
            $equipos[$i] = new Team();
            $equipos[$i]->setNombre($nombre." ".$defaultNames[$i]);
            $equipos[$i]->setIdTorneo_fk($torneo->getIdTorneo());
            $idEquipo = $equipos[$i]->save();
            $equipos[$i]->setIdEquipo($idEquipo);
            $i++;
        }
    }
    //Crear rondas tabla ronda y relacion equipo/ronda tabla equipo_ronda
    for($i = 1; $i <= 5; $i++){
        $ronda = new Round();
        $ronda->setIdTorneo_fk($torneo->getIdTorneo());
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

    if($torneo->finishTransaction()){
        return $createTournamentRes = "Torneo creado correctamente.";
    }else{
        return $createTournamentRes = "Ha habido un error inseperado, vuelve a crear el torneo por favor.";
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
// FUNIONES DE PEFIL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function verPermiso(){
    $value = $_SESSION['student']->getPermiso();
    if($value){
        echo "<td style='color:green'>¡Puedes participar en torneos!</td>";
    }else{
        echo "<td style='color:red'>No puedes participar en los torneos.</td>";
    }
}