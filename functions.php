<?php
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE LOGIN
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Comprobar que el login y contraseña son correctos por peticion a la base de datos
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
//Función para llevar el número de intentos de login
function checkAttempts(){
    if(isset($_SESSION['attempts'])){
        if($_SESSION['attempts'] == 3){
            return false;
        }else{
            $_SESSION['attempts']++;
            return true;
        }
    }
}
//Funcion para enviar mails a mi correo
function sendMail($subject, $message, $headers){
    $to = "aitorzunigacanovas@gmail.com";
    $fullMessage = $headers."\n".$message;
    
    return mail($to, $subject, $fullMessage, "From: aitor@torneos.ml");
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE NUEVO TORNEO
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Generar equipos dependiendo de si son equipos o indivudual utilizará una funcion u otra
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
//Función para devolver un valor aleatorio de mi array para combinar nombres
function returnName(){
    $defaultNames = array('Alpha','Beta','Gamma','Delta','Epsilon','Digamma','Stigma','Zeta','Heta','Eta','Theta','Iota','Yot','Kappa','Lamda','Mu','Nu','Xi','Omicron','Pi','San','Koppa','Rho','Sigma','Tau','Upsilon','Phi','Chi','Psi','Omega','Sampi','Sho');
    shuffle($defaultNames);
    return $defaultNames[0];
}
// Función para crear el torneo haciendo las inserciones a la DB haciendo una transacción
function createTournament($nombre, $agrup, $clase, $arrDeporte, $fecha, $comentario, $teamA, $teamB, $clase){
    $idDeporte = $arrDeporte[0];
    $deporte = $arrDeporte[1];
    
    //Creat torneo a table torneo
    $torneo = new Tournament();
    //Nueva transacción a la DB
    $torneo->beginTransaction();

    $torneo->setNombre($nombre);
    $torneo->setIdDeporte_fk($idDeporte);
    $torneo->setNumParticipantes(count($clase));
    $torneo->setModo($agrup);
    $torneo->setFecha($fecha);
    $torneo->setComentario($comentario);
    $idTorneo = $torneo->save();
    $torneo->setIdTorneo($idTorneo);
    
    if($teamA && $teamB){
        generateTwoTeams($idTorneo, $teamA, $teamB);
    }
    else{
        generateIndividualTeams($idTorneo, $clase);
    }
    
    if($torneo->finishTransaction()){
        return $createTournamentRes = "Torneo creado correctamente.";
    }else{
        return $createTournamentRes = "Ha habido un error inseperado, vuelve a crear el torneo por favor.";
    }
}
// Función para crear dos equipos para el torneo
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
// Función para crear equipos individuales para torneo individual
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
        $ronda->setRonda(1);
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

//Eliminar torneo especificado
function deleteTournament($id){
    $delTourn = new Tournament();
    $delTourn->deleteWhere('IdTorneo = '.$id);
}
//Empezar un torneo nuevo
function startTournament($id){
    $startTorneo = new Tournament();
    $tourn = $startTorneo->selectAdd("*", "WHERE IdTorneo = {$id}");
    $equipoRonda = new Team_round();
    $res = $equipoRonda->selectClean("SELECT B.IdRonda, B.Ronda,GROUP_CONCAT(c.IdEquipo, '~', c.Nombre, ' ') AS Equipo FROM equipo_ronda A INNER JOIN ronda B ON A.IdRonda_fk = B.IdRonda INNER JOIN equipo C ON C.IdEquipo = A.IdEquipo_fk WHERE B.IdGanador_fk IS NULL AND B.IdTorneo_fk = {$id} GROUP BY B.IdRonda ORDER BY B.Ronda");
    if(empty($res)){
        return "<span>Torneo finalizado</span>";
    }
    $idTorneo = $id;
    $insertResults = "<h3 class='text-center idTourn' for='{$idTorneo}'>{$tourn[0]->getNombre()} ({$idTorneo})</h3><h4>Seleccionar equipo ganador en cada ronda</h4>";
    $insertResults.= "<table class='table resTable'>"
                        . "<thead>"
                            . "<tr>"
                                . "<th>Ronda</th>"
                                . "<th>Equipo 1</th>"
                                . "<th>Equipo 2</th>"
                            . "</tr>"
                        . "</thead>"
                        . "<tbody>";
    
    if($tourn[0]->getModo() != "Individuala"){    
        foreach($res as $r){
            $teams = explode(" ,",  $r->Equipo);
            $teamA = explode("~", $teams[0]);
            $teamB = explode("~", $teams[1]);
            $insertResults.="<tr class='roundrow' roundid='".$r->IdRonda."'><td for='".$r->Ronda."'>".$r->Ronda."</td><td><button class='btnteam btn btn-primary teamA' idteam='".$teamA[0]."'>".$teamA[1]."</button></td><td><button class='btnteam btn btn-danger teamB' idteam='".$teamB[0]."'>".$teamB[1]."</buton></td></tr>";
        }
     
    }
    $insertResults.= "</tbody></table>";
    return $insertResults;
}
//Fúncion para insertar los ganadores de cada ronda
function insertTournRes(array $values){
    $winners = array();
    foreach($values as $v){
        $round = $v['roundid'];
        $team = $v['teamid'];
        $changes = array("IdGanador_fk" => $team);
        $roundW = new Round();
        $roundW->updateRow($changes, "IdRonda = {$round}");
    }
}
//Función para crear rondas si el torneo es individual cada vez que acabe una tanda de rondas hasta que finalice utilizara esta función
function createNewRounds(array $values){
    
    for($i = 0; $i < count($values);$i+=2){
        $newRound = new Round();
        $roundId = $values[$i]['roundid'];
        $teamId = $values[$i]['teamid'];
        $nextTeamId = $values[$i+1]['teamid'];
        $round = $values[$i]['round'];
        $idTourn = $values[0]['tournid'];
        $newRound->setRonda($round+1);
        $newRound->setIdTorneo_fk($idTourn);
        $idRound = $newRound->save();
        
        $teamRound = new Team_round();
        $teamRound->setIdRonda_fk($idRound);
        $teamRound->setIdEquipo_fk($teamId);
        $teamRound->save();
        
        $teamRound2 = new Team_round();
        $teamRound2->setIdRonda_fk($idRound);
        $teamRound2->setIdEquipo_fk($nextTeamId);
        $teamRound2->save();
    }
}
//Función para modificar un torneo
function modifyTournament(array $values){
    $modTourn = new Tournament();
    $id = $values['id'];
    $nombre = $values['nombre'];
    $fecha = $values['fecha'];
    $comentario = $values['comentario'];
    $vals = array(
        'Nombre'        => $nombre,
        'Fecha'         => $fecha,
        'Comentario'    => $comentario 
    );
    $where = 'IdTorneo = '.$id.'';
    return $modTourn->updateRow($vals, $where);
}
//Función para mostrar el último torneo
function showLastTourn(){
    $showTourn = new Tournament();
    $showTourn->getAll();
    
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE MOSTRAR RESULTADOS TORNEO + (GRACKETS)
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Función para comprobar que tipo de torneo es
function checkResultsType($id){
    $tournCheck = new Tournament();
    $res = $tournCheck->selectWhere(array("Modo, Nombre"), "IdTorneo = {$id}");
    $nombre = $res[0]->getNombre();
    if($res[0]->getModo() == "PorEquipos"){
        return checkTournResults($id, $nombre);
    }else{
        return getTournJSONResults($id, $nombre);
    }
}
//Función para mostrar los resultados de un torneo por equipos
function checkTournResults($id, $nombre){
    $roundJSON = new Round();
    $results = $roundJSON->selectClean("SELECT A.Ronda, B.Nombre FROM ronda A INNER JOIN equipo B ON A.IdGanador_fk = B.IdEquipo WHERE A.IdTorneo_fk = {$id}");
    $roundList = array();
    $teams = array();
    foreach($results as $val){
        $roundList[(int)$val->getRonda()] = $val->Nombre;
       if(!in_array($val->Nombre, $teams)){
           array_push($teams, $val->Nombre);
       }
    }
    $winner = array_count_values($roundList);
    $winnerId = array_search(max($winner),$winner);
    $table = "<div class='text-center fancyTitle'><h3>{$nombre}</h3></div>
                <div class='row col-sm-12 centerTs'>
                <div class='row col-sm-5 text-center'>
                    <h1 class='text-center label-primary radLeft'>{$teams[0]}</h1>
                </div>
                <div class='row col-sm-2 text-center'>
                    <h1 class='text-center label-default'>VS</h1>
                </div>
                <div class='row col-sm-5 text-right'>
                    <h1 class='text-center label-danger radRight'>$teams[1]</h1>
                </div>
              </div>
            <table id='tableTournaments' class='table'>
                <thead>
                    <tr>
                        <th>Ronda</th>
                        <th>Equipo</th>
                    </tr>
                </thead>
                <tbody>";
    foreach($roundList as $key => $value){
        $table.= "<tr><td>".$key."</td><td>".$value."</td></tr>";
    }
    $table.= "</tbody>
            </table>";
    return array($winnerId, $table);
}

//Función para mostrar resultados de un torneo individual utilizando GRACKETS
function getTournJSONResults($id, $nombre){
    $roundJSON = new Round();
    //SELECCIONAR EQUIPOS DE CADA RONDA Y PARTIDO DEL TORNEO
    $select = "SELECT B.IdRonda as `match`, B.Ronda as round,c.IdEquipo as id,c.Nombre as name FROM equipo_ronda A INNER JOIN ronda B ON A.IdRonda_fk = B.IdRonda INNER JOIN equipo C ON C.IdEquipo = A.IdEquipo_fk WHERE B.IdTorneo_fk = {$id}";
    $results = $roundJSON->selectAssoc($select);  
    //SELECCIONAR EL EQUIPO GANADOR DEL TORNEO
    $select2 = "SELECT B.IdGanador_fk as ganador FROM equipo_ronda A INNER JOIN ronda B ON A.IdRonda_fk = B.IdRonda INNER JOIN equipo C ON C.IdEquipo = A.IdEquipo_fk WHERE B.IdTorneo_fk = {$id} ORDER BY B.IdRonda DESC LIMIT 1";
    $roundJSON2 = new Round();
    $results2 = $roundJSON->selectAssoc($select2);
    $ganador = $results2[0]['ganador'];
    $teamWinner = array();
    $rounds = array();
    $nRes = 1;
    foreach($results as $r){

        $team = [
            'name' => $r['name'],
            'id'   => $r['name'],
            'seed' => $r['id']
        ];
        if(!array_key_exists($r['round'], $rounds)){
            $rounds[$r['round']] = []; 
            $nRes++;
        }
        if(!array_key_exists($r['match'], $rounds[$r['round']])){
            $rounds[$r['round']][$r['match']] = []; 
        }
        if($team['seed'] == $ganador){
            $teamWinner = $team;
        }

        array_push($rounds[$r['round']][$r['match']],$team);
    }   
    $winnerName = $teamWinner['name'];
    $rounds[$nRes][0] = array($teamWinner);
    
    $stringGracket = "[";
    foreach($rounds as $a){
        $stringGracket.= "[";
        foreach($a as $b){
            $stringGracket.= "[";
            foreach($b as $c){
                $stringGracket.= '{"name":"'.$c['name'].'", "id":"'.$c['id'].'", "seed":"'.$c['seed'].'"},';
            }
            $stringGracket = substr($stringGracket, 0, -1);
            $stringGracket.= "],";
        }
        $stringGracket = substr($stringGracket, 0, -1);
        $stringGracket.= "],";
    }
    $stringGracket = substr($stringGracket, 0, -1);
    $stringGracket.= "]";
    
    return array($winnerName, "<div class='text-center fancyTitle'><h3>{$nombre}</h3></div>"
    . "<div data-gracket='".$stringGracket."'></div>");
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE AYUDA
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Función para acortar expresión muy utilizada para hacer "debug"
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
//Crear paths, contraseñas...
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE PEFIL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Función para mostrar un mensaje dependiendo del permiso del usuario
function verPermiso(){
    $value = $_SESSION['student']->getPermiso();
    if($value){
        echo "<td style='color:green'>¡Puedes participar en torneos!</td>";
    }else{
        echo "<td style='color:red'>No puedes participar en los torneos.</td>";
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE GESTIONAR ALUMNOS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Función para crear un usuario y estudiante nuevo y insertarlo en la base de datos
function addUser(array $values){
    echopre($values);
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
    $stud->setUsuario_fk($values['Login']);
    return $stud->save();
}
//Función para eliminar un usuario y estudiante
function delUser($id){
    $delStud = new Student();
    $userVal = $delStud->selectWhere(array('Usuario_fk'), 'IdAlumno = '.$id.'');
    $delUser = new User();
    $delUser->deleteWhere("Login = '".$userVal[0]->getUsuario_fk()."'");
}
//Función para cambiar el permiso de un estudiante
function changePermisUser($id){
    $stud = new Student();
    $data = 'Permiso = case WHEN Permiso = 1 THEN 0 ELSE 1 END WHERE IdAlumno = '.$id.'';
    $stud->updateCleanRow($data);
}
//Función para hacer cambios en los datos de un estudiante
function updateStudent($values){
    print_r();
    $stud = new Student();
    $vals = array(
        'Nombre'    => $values['nombre'],
        'Apellido'  => $values['apellido'],
        'Email'     => $values['email'],
        'Curso_fk'  => $values['curso']
    );
    $where = 'IdAlumno = '.$values['id'].'';
    return $stud->updateRow($vals, $where);
}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES MI PERFIL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Función para cambiar la contraseña del usuario logueado
function changePassword($id, $pswd){
    $pswdUser = new User();
    $changes = array('Password' => ''.$pswd['pswd'].'');
    $where = "Login = '{$id}'";
    $_SESSION['user']->setPassword($pswd['pswd']);
    return $pswdUser->updateRow($changes, $where);
}
//Cambiar email del estudiante logueado
function changeEmail($email){
    $stud = new Student();
    $stud->updateRow(array("Email" => $email), "IdAlumno = ".$_SESSION['student']->getIdAlumno());
}
//Función para subir una imagen
function uploadImage(){
    $dir = "public/images/users/";
    $timeVal = generateRandomString();
    $ext = substr($_FILES['inpFile']['name'], strpos($_FILES['inpFile']['name'], "."));
    $imgName = $_SESSION['student']->getNombre().$_SESSION['student']->getApellido().$timeVal.$ext;
    $target_file = $dir . basename($imgName);
    $uploadOk = 1;
    $type = exif_imagetype($_FILES['inpFile']['tmp_name']);
    // Tamaño imagen
    if ($_FILES["inpFile"]["size"] > 500000) {
        return "Imagen demasiado grande. Max(500Kb)";
    }
    // Formatos de la imagen
    if($type != IMAGETYPE_JPEG && $type != IMAGETYPE_PNG) {
        return "Error de extensión, Extensiones habilitadas (jpeg, png).";
    }
    // Guardar imagen
    if (move_uploaded_file($_FILES["inpFile"]["tmp_name"], $target_file)) {
        if($_SESSION['user']->getAvatar() != 'ico.png'){
            // Eliminar imagen anterior si no es la imgaen por defecto
            if(file_exists($dir.$_SESSION['user']->getAvatar())){
                unlink($dir.$_SESSION['user']->getAvatar());
            }
        }
        $_SESSION['user']->setAvatar($imgName);
        $userImg = new User();
        $userImg->updateRow(array("Avatar" => $imgName), "Login = '".$_SESSION['user']->getLogin()."'");
        return true;
    } else {
        return "Lo siento, ha habido un error subiendo tu imagen.";
    }
    
}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// FUNCIONES DE GESTIONAR DEPORTES
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    
//Función para crear un deporte subiendo imagen y datos a la DB
function createSport($nombre, $descripcion, $imagen){
    //Subir la imagen
    $dir = "public/images/new_tournament/";
    $timeVal = generateRandomString();
    $ext = substr($imagen['name'], strpos($imagen['name'], "."));
    $imgName = $timeVal.$ext;
    $target_file = $dir . basename($imgName);
    $uploadOk = 1;
    $type = exif_imagetype($imagen['tmp_name']);
    // Tamaño imagen
    if ($imagen["size"] > 500000) {
        return "Imagen demasiado grande. Max(500Kb)";
    }
    // Formatos de la imagen
    if($type != IMAGETYPE_JPEG && $type != IMAGETYPE_PNG) {
        return "Error de extensión, extensiones habilitadas (jpeg, png).";
    }
    // Guardar imagen
    if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
        $sportImg = new Sport();
        $sportImg->setNombre($nombre);
        $sportImg->setDescripcion($descripcion);
        $sportImg->setImagen($imgName);
        $sportImg->save();
        return true;
    } else {
        return "Lo siento, ha habido un error creando el deporte.";
    }
}
//Función para modificar un deporte
function modifySport($id, $nombre, $descripcion, $imagen, $uploadImg = false){
    
    if($uploadImg == true){
        //Subir la imagen
        $dir = "public/images/new_tournament/";
        $timeVal = generateRandomString();
        $ext = substr($imagen['name'], strpos($imagen['name'], "."));
        $imgName = $timeVal.$ext;
        $target_file = $dir . basename($imgName);
        $uploadOk = 1;
        $type = exif_imagetype($imagen['tmp_name']);
        // Tamaño imagen
        if ($imagen["size"] > 500000) {
            return "Imagen demasiado grande. Max(500Kb)";
        }
        // Formatos de la imagen
        if($type != IMAGETYPE_JPEG && $type != IMAGETYPE_PNG) {
            return "Error de extensión, extensiones habilitadas (jpeg, png).";
        }
        // Guardar imagen
        if (move_uploaded_file($imagen["tmp_name"], $target_file)) {
            $sportImg = new Sport();
            $sportImg->updateRow(array("Nombre" => $nombre, "Descripcion" => $descripcion,"Imagen" => $imgName), "IdDeporte = ".$id."");
            return true;
        } else {
            return "Lo siento, ha habido un error modificando el deporte.";
        }
    }else{
        $sportImg = new Sport();
        $sportImg->updateRow(array("Nombre" => $nombre, "Descripcion" => $descripcion), "IdDeporte = ".$id."");
        return "Cambios guardados";
    }
    
}
//Funcion para eliminar un deporte
function deleteSport($id){
    $delTourn = new Sport();
    $delTourn->deleteWhere('IdDeporte = '.$id);
}