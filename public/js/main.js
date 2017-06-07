$(function () {
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//alerts (alerts que se ejecutan recogiendo parámetros de la URL)
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //VARIABLES
    
    var $_GET = getQueryParams(document.location.search);
    
    //ACCIONES
    
    if (JSON.stringify($_GET) == '{"page":"nuevo_torneo","crearTorneo":"true"}') {
        alertify.success('Torneo creado');
    }
    if (JSON.stringify($_GET) == '{"page":"registro","tryLog":"true"}') {
        alertify.success('Logueado');
    }
    if (JSON.stringify($_GET) == '{"page":"gestion_deportes","modifySport":"true"}') {
        console.log($('#responseSport'));
        alertify.alert("Acción: Modificar deporte", $('#responseSport').html());
    }
    if (JSON.stringify($_GET) == '{"page":"gestion_deportes","createSport":"true"}') {
        alertify.alert("Acción: Crear deporte", $('#responseSport').html());
    }
    
    //FUNCIONES
    
    function getQueryParams(qs) {
        qs = qs.split("+").join(" ");
        var params = {},
                tokens,
                re = /[?&]?([^=]+)=([^&]*)/g;

        while (tokens = re.exec(qs)) {
            params[decodeURIComponent(tokens[1])]
                    = decodeURIComponent(tokens[2]);
        }
        return params;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//MODIFICAR PERFIL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    

    //VARIABLES

    $profileEmail = $('.editEmail');
    $profilePasswd = $('.editPasswd');
    $saveProfile = $('#btnSaveProfile');
    $cancelProfile = $('#btnCancelProfile');
    $editProfile = $('#btnEditProfile');
    $selImg = $('#selImg');
    $imgContainer = $('.imgContainer');
    $imgProfile = $('#imgProfile');
    $fadeEffect = $('#fadeEffect');

    //ACCIONES

    $('#btnEditProfile').click(function () {
        // Visibilizar iconos, inputs, botones para editar perfil
        toggleProfile();
    });
    $('.changePass').click(function(){
        genericDialog($('#changePassword')[0]);
    });

    $cancelProfile.click(function () {
        alertify.error("Acción cancelada");
        // Visibilizar iconos, inputs, botones para cancelar editar perfil
        toggleProfile(true);
        $profilePasswd.val("");
        $profileEmail.val($('.editEmail').val());
    });

    // Guardar perfil
    $saveProfile.click(function () {
        $result = checkProfileValues();
        if($result.length == 0){
            $('#profileForm')[0].submit();
        }else{
            alertify.error($result);
        }
    });
    //Previsualizar imagen nueva perfil
    $("#inpFile").change(function() {
      readURL(this);
    });
    //Seleccionar imagen nueva
    $("#selImg").click(function(){
        $("#inpFile").click();
    });
    //Comprobar contraseña
    $('#savePass').click(function () {
        $oldPswd = $('#actualPass');
        $newPswd = $('#cambiarPswd');
        var pswdRegex = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,20}$/;

        if (!$newPswd.val().match(pswdRegex)){
            alertify.error('Contraseña no válida,mínimo 1 mínuscula, 1 máyuscula, 1 número (8 - 20) caracteres')
            return false;
        }
        //Envío de datos por ajax (se recoge en el action_controller)
        $.get("index.php", {isAjaxReq: true, checkMyPswd: true})
            .done(function(){
                if(data == $oldPswd.val()){
                    var obj = {
                        pswd: $newPswd.val()
                    };
                    $.get("index.php", {isAjaxReq: true, changePswd: JSON.stringify(obj)})
                        .done(function(){
                                alertify.success("Cambios guardados");
                        })
                        .fail(function() {
                            alertify.error("Error cambiando contraseña");
                        });
                }else{
                    alertify.error("Contraseña antigua incorrecta");
                }
            })
            .fail(function() {
                alertify.error("Error cambiando contraseña");
            });
    });
    // Efecto para ver contraseña
    $('.verPswd').mousedown(function () {
        $(this).next().attr("type", "text");
    });
    $('.verPswd').mouseup(function () {
        $(this).next().attr("type", "password");
    });

    //FUNCIONES

    function toggleProfile($cancelEdit = false) {
        $profileEmail.toggle();
        $profilePasswd.toggle();
        $saveProfile.toggle();
        $cancelProfile.toggle();
        $editProfile.toggle();
        $selImg.toggle();
        $imgContainer.mouseover(function () {
            if ($cancelEdit == false) {
                $imgProfile.css('opacity', '0.7');
                $fadeEffect.css('opacity', '1');
            } else {
                $imgProfile.css('opacity', '1');
                $fadeEffect.css('opacity', '0');
            }
        });
        $imgContainer.mouseout(function () {
            $imgProfile.css('opacity', '1');
            $fadeEffect.css('opacity', '0');
        });
    }

    function checkProfileValues() {
        // variables
        $message = "";
        // Comprobar email
        $emailRegex = /^.+\@.+\.[a-z]{2,}$/;
        if (!$emailRegex.test($('#cambiarEmail').val())) {
            $message += "¡El correo debe ser valido!\n";
        }
        return $message;
    }
    
    //Mostrar imagen cargada
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imgProfile').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CREAR TORNEO
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    $nStuds = $('.btn .dropdown-toggle .btn-default');
    //ACCIONES

    $('#elegirCurso').change(function () {
        $('players').attr("display", "none");
        $('.players').toggle(200);
    });

    $('#sendNewTourn').click(function(){ 
        $validate = validateNewTournament();
        if ($validate.length == ""){
            $('#tournamentSubmit').click();
        }else{
            alertify.alert('Error al introducir los datos', $validate, function () {});
        }
    });

    
    //FUNCIONES
    
    function validateNewTournament(){
        $nValidPlayers = [4, 8, 16, 32, 64];
        $players = $('.btn.dropdown-toggle.btn-default')[3].getAttribute("title");
        $nPlayers = $players.split(",");
        $message = "";
        $dateCheck = /^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;

        if ($('select[name="sportName"]').val() == null) {
            $message += "Elige un deporte<br>";
        }
        if ($('input[name="nameTournament"]').val() == null) {
            $message += "Elige un nombre para el torneo<br>";
        }
        if ($('select[name="gameType"]').val() == null) {
            $message += "Elige el tipo de agrupación<br>";
        }
        console.log($nPlayers.length);
        if($nPlayers.length <= 1){
            $message += "Elige más alumnos para que participen en el torneo<br>";
        }
        if ($('select[name="gameType"]').val() == 'Individual')
        if (jQuery.inArray($nPlayers.length, $nValidPlayers) == -1) {
            $message += "En torneo individual el número de jugadores debe ser uno de los siguientes: 4, 8, 16, 32, 64<br>";
        }
        if (!$dateCheck.test($('#myDate').val())) {
            $message += "Elige una fecha<br>";
        }
        return $message;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//GESTIONAR TORNEOS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    //Si la fecha del torneo ya ha pasado empezar torneo directamente 
    $('.lateTourn').click(function () {
        $(this).closest('form').submit();
    });
    //Si la fecha del torneo aún no ha llegado confirmación para empezar el torneo
    $('.prevTourn').click(function () {
        $btn = $(this).parent();
        alertify.confirm('Empezar torneo', 'Aun no es la fecha de inicio. ¿Estás seguro de que quieres empezar el torneo?', function (e) {
            if(e){
                $btn.submit();
            }
        }
        , function () {
            alertify.error('Cancel')
        });
    });
    //Funcion para mostrar una ventana para hacer cambios en un torneo
    $('.editTourn').click(function(){
        $id = $('input[name="idTourn"]');
        $nombre = $('input[name="modifyNombre"]');
        $fecha = $('input[name="modifyFecha"]');
        $comentario = $('textarea[name="modifyComentario"]');
        $id.val($(this).closest('tr').find('.idTorneo').attr('for'));
        $nombre.val($(this).closest('tr').find('.Nombre').attr('for'));
        $fecha.val($(this).closest('tr').find('.fecha').attr('for'));
        $comentario.val($(this).closest('tr').find('.comentario').attr('for'));
        genericDialog($('#modifyTournament')[0]);
    });
    //Guardar cambios de torneo modificado
    $('#saveTournamentChanges').click(function(){
        if(checkTournChanges() == ""){
            var obj = {
                id: $id.val(),
                nombre: $nombre.val(),
                fecha: $fecha.val(),
                comentario: $comentario.val(),
            }
            //Envío de datos por ajax (se recoge en el action_controller)
            $.get("index.php", {isAjaxReq: true, modifyTournament: JSON.stringify(obj)})
                    .done(function(){
                        alertify.success("Cambios guardados");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                    })
                    .fail(function() {
                        alertify.error("Error modificando torneo");
                    });
        }else{
            alertify.alert('Error al introducir los datos', $message, function () {});
        }
    });
    //FECHA INPUT LETRAS NO VÁLIDAS
    $('input[name="modifyFecha"]').keydown(function(e){-1!==$.inArray(e.keyCode,[46,8,9,27,13,110,190])||/65|67|86|88/.test(e.keyCode)&&(!0===e.ctrlKey||!0===e.metaKey)||35<=e.keyCode&&40>=e.keyCode||(e.shiftKey||48>e.keyCode||57<e.keyCode)&&(96>e.keyCode||105<e.keyCode)&&e.preventDefault()});
    
    $(".deleteTourn").click(function () {
        $btnDel = $(this);
        $id = $btnDel.attr("for");
        alertify.confirm('Eliminar torneo', "¿Estás seguro de que quieres eliminar el torneo? Todos los datos referentes al torneo se eliminarán.", function (e) {
            if(e){
                var obj = {id: $id};
                //Envío de datos por ajax (se recoge en el action_controller)
                $.get("index.php", {isAjaxReq: true, delTournament: JSON.stringify(obj)})
                    .done(function(){
                        alertify.success("Torneo eliminado");
                        $btnDel.parent().parent().hide();
                    })
                    .fail(function() {
                        alertify.error("Error eliminando torneo");
                    });
            }
        }, function () {
            alertify.error('Acción cancelada');
        });
    });
    // Elegir equipo ganador de cada ronda
    $('.btnteam').click(function () {
        if ($(this).hasClass('teamA')) {
            $closestTB = $(this).closest('tr').find('.teamB');
            if ($closestTB.hasClass('selected')) {
                $closestTB.removeClass('selected btn-warning').addClass('btn-danger');
            }
        } else if ($(this).hasClass('teamB')) {
            $closestTA = $(this).closest('tr').find('.teamA');
            if ($closestTA.hasClass('selected')) {
                $closestTA.removeClass('selected btn-warning').addClass('btn-primary');
            }
        }
        $(this).addClass('selected').removeClass('btn-danger btn-primary').addClass('btn-warning')
    });

    //
    $('#sendResults').click(function () {
        // Validar que todas las rondas han sido seleccionadas
        if ($('.table.resTable tr.roundrow').length != $('.table.resTable tr .btnteam.selected').length){
            alertify.error("Debes seleccionar un equipo para cada ronda.");
            return false;
        }
        $teamsSelected = $('.btnteam.selected');
        $ts = [];
        $ind = [];
        $indTs = [];
        $idTourn = $('.idTourn').attr('for');
        //Envío de datos por ajax (se recoge en el action_controller)
        $teamsSelected.each(function () {
            $id = $(this).attr('idteam');
            $rondaId = $(this).closest('tr').attr('roundid');
            $ronda = $(this).closest('td').siblings(':first-child').attr('for');
            var obj = {
                roundid: $rondaId,
                teamid: $id
            };
            var obj2 = {
                roundid: $rondaId,
                round: $ronda,
                teamid: $id,
                tournid: $idTourn
            };
            $indTs.push(obj2);
            if(!$ind.includes($id)){
                $ind.push($id);
            }
            
            $ts.push(obj);
        });
        //Comprobar si el torneo es individual o por equipos determinando el número de equipos únicos que juegan el torneo y el número de rondas que juegan
        if($ind.length > 2 || $('.table.resTable tr.roundrow').length == 2){
            //Envío de datos por ajax (se recoge en el action_controller)
            $.get("index.php", {isAjaxReq: true, indTeams: JSON.stringify($indTs)})
            .done(function () {
                alertify.success("¡Siguiente ronda!");
                setTimeout(function() {
                    window.location.href = 'index.php?page=gestion_torneos&startTournament=' + $idTourn;
                }, 1000);
            })
            .fail(function () {
                alertify.error("error");
            });
        }else{
            //Envío de datos por ajax (se recoge en el action_controller)
            $.get("index.php", {isAjaxReq: true, teamsSel: JSON.stringify($ts)})
            .done(function () {
                alertify.success("Datos guardados");
                $('#sendResults').hide();
                setTimeout(function() {
                    window.location.href = 'index.php?page=results&showResults=' + $idTourn;
                }, 1000);
            })
            .fail(function () {
                alertify.error("error");
            }); 
        }
    });

    function checkTournChanges(){
        $message = "";
        $nombre = $('input[name="modifyNombre"]');
        $fecha = $('input[name="modifyFecha"]');
        $comentario = $('textarea[name="modifyComentario"]');
        //Solo letras válidas
        if(!$nombre.val().match(/^[a-zA-Z ]+$/)){
            $message+= "Nombre incorrecto<br>";
        }
        //Validar fecha con formato(YYYY-MM-DD hh:mm:ss)
        if(!$fecha.val().match(/[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) (2[0-3]|[01][0-9]):[0-5][0-9]:[0-5][0-9]/)){
            $message+= "Debes introducir una fecha válida (YYYY-MM-DD hh:mm:ss)<br>";
        }
        //Solo letras válidas
        if(!$comentario.val().match(/^[a-zA-Z ]+$/)){
            $message+= "Comentario no válido<br>";
        }
        return $message;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//MI CURSO (GESTIÓN)
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Cambiar el permiso para jugar del estudiante
    $('.studPermis').click(function () {
        $idStudent = $(this).closest('tr').find($('.IdAlumno'));
        $id = $idStudent.attr('for');
        var obj = {id:$id};
        //Envío de datos por ajax (se recoge en el action_controller)
        $.get("index.php", {isAjaxReq: true, changePermisUser: JSON.stringify(obj)})
            .done(function(data){
                alertify.success("Permiso cambiado");
            setTimeout(function() {
                location.reload();
            }, 1000);
            })
            .fail(function() {
                alertify.error("Error cambiando permiso");
            });
    });
    //Modificar datos de un estudiante
    $('.editStud').click(function (){
        $id = $(this).closest('tr').find($('.IdAlumno'));
        $nombre = $(this).closest('tr').find($('.Nombre'));
        $apellido = $(this).closest('tr').find($('.Apellido'));
        $email = $(this).closest('tr').find($('.Email'));
        $usuario = $(this).closest('tr').find($('.Usuario_fk'));
        $curso = $('#thisCourse');
        genericDialog($('#modifyStudent')[0]);
        $('input[name="modifyName"]').val($nombre.attr('class').split(' ').pop());
        $('input[name="modifySurname"]').val($apellido.attr('class').split(' ').pop());
        $('input[name="modifyEmail"]').val($email.attr('class').split(' ').pop());
        $('input[name="modifyCourse"]').val($curso.attr('class'));
        $('input[name="modifyUser"]').val($usuario.attr('class').split(' ').pop());
        $('input[name="studentIdMod"]').val($id.attr('for'));
    });
    //Guardar cambios de la modificación
    $('span[name="saveStudentChanges"]').click(function(){
        var obj = {
            id:$('input[name="studentIdMod"]').val(),
            nombre:$('input[name="modifyName"]').val(),
            apellido:$('input[name="modifySurname"]').val(),
            email:$('input[name="modifyEmail"]').val(),
            curso:$curso.attr('class')
        }
        if(validateChanges().length == 0){
            //Envío de datos por ajax (se recoge en el action_controller)
            $.get("index.php", {isAjaxReq: true, saveStudentChanges: JSON.stringify(obj)})
                .done(function(data){
                    alertify.success("Datos de de Estudiante/Usuario modificados");
                    setTimeout(function() {
                            location.reload();
                        }, 1000);
                })
                .fail(function() {
                    alertify.error("Error modificando Estudiante/Usuario");
                });
        }else{
            alertify.alert("Datos no válidos", $message);
        }
    });
    //Eliminar a un estudiante
    $('.deleteStud').click(function(){
        $idStudent = $(this).closest('tr').find($('.IdAlumno'));
        $btn = $('.deleteStud');
        $tr = $(this).closest('tr');
        alertify.confirm('Eliminar usuario', '¿Estás seguro de que quieres eliminar los datos de este estudiante?', function (e) {
            if(e){
                $id = $idStudent.attr('id');
                var obj = {id: $idStudent.attr('for')};
                //Envío de datos por ajax (se recoge en el action_controller)
                $.get("index.php", {isAjaxReq: true, delStud: JSON.stringify(obj)})
                    .done(function(){
                        alertify.success("Estudiante/Usuario eliminado");
                        $tr.hide();
                    })
                    .fail(function() {
                        alertify.error("Error eliminando Estudiante/Usuario");
                    });
            }
        }
        , function () {
            alertify.error('Acción cancelada');
        });
    });
    //Mostrar la ventana para añadir un estudiante nuevo
    $('#addUser').click(function(){
        genericDialog($('#createStudent')[0]);
    });
    //Función de autocompletado para algunos de los inputs de la ventana crear estudiante nuevo
    $('input[name="createSurname"]').keyup(function(){
        $rand = Math.floor((Math.random() * 9999) + 1000);
        $user = $('input[name="createName"]').val().toLowerCase().substring(0,1) + $('input[name="createSurname"]').val().toLowerCase() + $rand;
        $email = $('input[name="createName"]').val().toLowerCase() + $rand + '@gmail.com';
        $('input[name="createEmail"]').val($email);
        $('input[name="createLogin"]').val($user);
    });
    //Validar que los campos sean válidos y una vez hecho enviar petición ajax para guardarlo
    $('#createStudentBtn').click(function(){
        $message = validateNew();
        if($message.length == 0){
            obj = {
                Login:$('input[name="createLogin"]').val(),
                Password:$('input[name="createPassword"]').val(),
                Avatar:"ico.png",
                Rango_fk:$('input[name="userType"]').val(),
                Nombre:$('input[name="createName"]').val(),
                Apellido:$('input[name="createSurname"]').val(),
                Email:$('input[name="createEmail"]').val(),
                Permiso:"1",
                Curso:$('input[name="createCourse"]').val(),
                Usuario:$('input[name="createLogin"]').val()
            };
            //Envío de datos por ajax (se recoge en el action_controller)
            $.get("index.php", {isAjaxReq: true, addStud: JSON.stringify(obj)})
                .done(function(){
                    alertify.success("Estudiante/Usuario creado");
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                })
                .fail(function() {
                    alertify.error("Error creando Estudiante/Usuario");
                });
        }else{
            alertify.alert("Datos no válidos", $message);
        }
    });
    // Función de api ALERTIFY para mostrar en una ventana a parte formularios
    function genericDialog($button){
        alertify.genericDialog || alertify.dialog('genericDialog',function(){
        return {
            main:function(content){
                this.setContent(content);
            },
            setup:function(){
                return {
                    focus:{
                        element:function(){
                            return this.elements.body.querySelector(this.get('selector'));
                        },
                        select:true
                    },
                    options:{
                        basic:true,
                        maximizable:false,
                        resizable:false,
                        padding:true
                    }
                };
            },
            settings:{
                selector:undefined
            }
        };
    });
    alertify.genericDialog ($button);
    }
    //Validador de campos para modificar datos de estudiante
    function validateChanges(){
        $message = "";
        //Verificar que es un nombre sin números ni carácteres especiales
        if(!$('input[name="modifyName"]').val().match('^[a-zA-Z]{3,16}$')){
            $message+= "Nombre no válido<br>";
        }
        //Verificar que es un nombre sin números ni carácteres especiales
        if(!$('input[name="modifySurname"]').val().match('^[a-zA-Z]{3,16}$')){
            $message+= "Apellido no válido<br>";
        }
        //Verificar que empiece por cualquier carácter seguido de @ seguido de cualquier caracter, un punto y finalmente dos letras o más.
        if(!$('input[name="modifyEmail"]').val().match(/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i)){
            $message+= "Email no válido (ej: ejemplo@ejemplo.es)<br>";
        }
        //Verificar que el curso no este vacío y que se encuentre entre 1 y 4
        if(isNaN($('input[name="modifyCourse"]').val()) || $('input[name="modifyCourse"]').val() <= 0 || $('input[name="modifyCourse"]').val() >= 5){
            $message+= "Curso no válido (ej: 1) 1 - 4<br>";
        }
        return $message+= "";
    }
    //Validador de campos para crear estudiante
    function validateNew(){
        $message = "";
        //Verificar que es un nombre sin números ni carácteres especiales
        if(!$('input[name="createName"]').val().match('^[a-zA-Z]{3,16}$')){
            $message+= "Nombre no válido<br>";
        }
        //Verificar que es un nombre sin números ni carácteres especiales
        if(!$('input[name="createSurname"]').val().match('^[a-zA-Z]{3,16}$')){
            $message+= "Apellido no válido<br>";
        }
        //Verificar que empiece por cualquier carácter seguido de @ seguido de cualquier caracter, un punto y finalmente dos letras o más.
        if(!$('input[name="createEmail"]').val().match(/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i)){
            $message+= "Email no válido (ej: ejemplo@ejemplo.es)<br>";
        }
        //Verificar que el curso no este vacío y que se encuentre entre 1 y 4
        if(isNaN($('input[name="createCourse"]').val()) || $('input[name="createCourse"]').val() <= 0 || $('input[name="createCourse"]').val() >= 5){
            $message+= "Curso no válido (ej: 1) 1 - 4<br>";
        }
        //Verificar que es un nombre
        if(!$('input[name="createLogin"]').val().match(/^[ a-z0-9]*$/)){
            $message+= "Usuario no válido, (6 - 20) caracteres<br>";
        }
        //Verificar que la contraseña este comprendida entre 8 y 20 caracteres y que contenga una mayúscula y un numero como mínimo
        if(!$('input[name="createPassword"]').val().match(/^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,20}$/)){
            $message+= "Contraseña no válida, mínimo 1 mayúscula, 1 número (8 -20) caracteres<br>";
        }
        return $message+= "";
    }
    // JQUERY API ACTIONS
    $('#classTable').DataTable({
        ordering:false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ resultados por página",
            "zeroRecords": "Ningún resultado encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados disponibles",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    });
    $('#tableTournaments').DataTable({
        "searching": false,
        "paging":   false,
        "info":     false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ resultados por página",
            "zeroRecords": "Ningún resultado encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados disponibles",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    });
    $('#tableSports').DataTable({
        "searching": false,
        "paging":   false,
        "info":     false,
        "language": {
            "lengthMenu": "Mostrar _MENU_ resultados por página",
            "zeroRecords": "Ningún resultado encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados disponibles",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    });
    $('#table1ESO').DataTable({
        "language": {
            "lengthMenu": "Mostrar _MENU_ resultados por página",
            "zeroRecords": "Ningún resultado encontrado",
            "info": "Mostrando página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay resultados disponibles",
            "infoFiltered": "(filtered from _MAX_ total records)"
        }
    });
    $("[data-gracket]").gracket({
        roundLabels : ["Ronda 1", "Ronda 2", "Ronda 3", "Ronda 4", "Ronda 5", "Ronda 6", "Ronda 7", "Ronda 8"],
        canvasLineColor : "#000000",
        canvasLineWidth : 2,      
	canvasLineGap : 16,        
	cornerRadius : 2,        
	canvasLineCap : "round" 
    });

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//ENVIAR MAIL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    //Enviar mail para que el usuario reciba una respuesta automática
    $('#sendMail').click(function(){
        $message = $('#message').val();
        $headers = "From: " + $('#headers').val();
        $subject = $('input[name="name"]').val();
        var obj = {
            subject:$subject,
            headers:$headers,
            message:$message
        };
        //Envío de datos por ajax (se recoge en el action_controller)
        $.get("index.php", {isAjaxReq: true, sendMail: JSON.stringify(obj)})
            .done(function(){
                alertify.success("Mensaje enviado");
            })
            .fail(function() {
                alertify.error("Error al enviar mensaje");
            });
    });


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//GESTIONAR DEPORTES
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//Funcion para mostrar una ventana para hacer cambios en un torneo
    $('.editSport').click(function(){
        $id = $('input[name="idSport"]');
        $nombre = $('input[name="modifySportName"]');
        $descripcion = $('textarea[name="modifySportDesc"]');
        $imagen = $('img[name="modifySportImg"]');
        $id.val($(this).closest('tr').find('.idSport').attr('for'));
        $nombre.val($(this).closest('tr').find('.Nombre').attr('for'));
        $descripcion.val($(this).closest('tr').find('.Descripcion').attr('for'));
        $imagen.attr('src', ($(this).closest('tr').find('.imgEdit').attr('src')));
        $imagen.addClass('imgEdit');
        genericDialog($('#modifySport')[0]);
    });
    $('#addSport').click(function(){
        $nombre = $('input[name="createSportName"]');
        $descripcion = $('textarea[name="createSportDesc"]');
        $imagen = $('img[name="createSportImg"]');
        $imagen.attr('src', '');
        genericDialog($('#createSport')[0]);
    });
    //Guardar cambios de deporte modificado
    $('#saveSportChanges').click(function(){
        $message = checkSportChanges();
        if($message == ""){
            $('#modifySport')[0].submit();
        }else{
            alertify.alert('Error al introducir los datos', $message, function () {});
        }
    });
    //Guardar deporte creado
    $('#saveSport').click(function(){
        $message = checkNewSport();
        if($message == ""){
            $('#createSport')[0].submit();
        }else{
            alertify.alert('Error al introducir los datos', $message, function () {});
        }
    });
    
    $(".deleteSport").click(function () {
        $btnDel = $(this);
        $id = $btnDel.attr("for");
        alertify.confirm('Eliminar deporte', "¿Estás seguro de que quieres eliminar el deporte?", function (e) {
            if(e){
                var obj = {id: $id};
                //Envío de datos por ajax (se recoge en el action_controller)
                $.get("index.php", {isAjaxReq: true, delSport: JSON.stringify(obj)})
                    .done(function(){
                        alertify.success("Deporte eliminado");
                        $btnDel.parent().parent().hide();
                    })
                    .fail(function() {
                        alertify.error("Error eliminando deporte");
                    });
            }
        }, function () {
            alertify.error('Acción cancelada');
        });
    });
    //Previsualizar imagen nueva deporte
    $("#inpModifyFile").change(function() {
        readSportURL(this);
    });
    $("#inpCreateFile").change(function() {
        readSportURL(this);
    });
    function checkSportChanges(){
        $message = "";
        $nombre = $('input[name="modifySportName"]');
        $descripcion = $('textarea[name="modifySportDesc"]');
        //Solo letras válidas
        if(!$nombre.val().match(/^[a-zA-Z ]+$/)){
            $message+= "Nombre incorrecto<br>";
        }
        //Solo letras válidas
        if(!$descripcion.val().match(/^[a-zA-Z ]+$/)){
            $message+= "Descripcion no válido<br>";
        }
        return $message;
    }
    function checkNewSport(){
        $message = "";
        $nombre = $('input[name="createSportName"]');
        $descripcion = $('textarea[name="createSportDesc"]');
        //Solo letras válidas
        if(!$nombre.val().match(/^[a-zA-Z ]+$/)){
            $message+= "Nombre incorrecto<br>";
        }
        //Solo letras válidas
        if(!$descripcion.val().match(/^[a-zA-Z ]+$/)){
            $message+= "Descripcion no válido<br>";
        }
        return $message;
    }
    
    function readSportURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('.imgSport').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
});