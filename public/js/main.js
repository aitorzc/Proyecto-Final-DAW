$(function () {
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//alerts
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
    $imgContainer = $('.imgContainer');
    $imgProfile = $('#imgProfile');
    $fadeEffect = $('#fadeEffect');

    //ACCIONES

    $('#btnEditProfile').click(function () {
        // Visibilizar iconos, inputs, botones para editar perfil
        toggleProfile();
    });

    $('#btnCancelProfile').click(function () {
        alertify.error("Acción cancelada");
        // Visibilizar iconos, inputs, botones para cancelar editar perfil
        toggleProfile(true);
        $('.editPasswd').val("");
        $('.editEmail').val($('.editEmail').val());
    });

    $("#profileForm").submit(function (e) {
        //todo: crear array de variables
        //json encode array
        //send post to app endpoint with the json 
        //sucess/failure message/...

        //$.post();
        alert("SUBMIT");
        //e.preventDefault();
    });

    // Guardar perfil
    $('#btnSaveProfile').click(function () {
        $result = checkProfileValues();

        if ($result.length == 0) {
            alertify.confirm('Confirm Title', 'Confirm Message', function () {
                alertify.success('Accepted');
                $("#profileForm").submit();
            }, function () {
                alertify.error('Declined');
            }).setting('labels', {'ok': 'Accept', 'cancel': 'Decline'});
        } else {
            alertify.error($result);
        }
    });

    //Mostrar imagen cargada
    $("#inpFile").change(function () {
        if ($(this).files && $(this).files[0]) {
            console.log("entra");
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#imgProfile').attr('src', e.target.result);
            }
            reader.readAsDataURL($(this).files[0]);
        }
    });
    //Comprobar contraseña
    $('#checkPswd').click(function () {
        var pswdRegex = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,20}$/;
        if (pswd.value.length != 0 && !(pswdRegex.test(pswd.value))) {
            return true
        }
    });
    // Efecto para ver contraseña
    $('#verPswd').mousedown(function () {
        $('#cambiarPswd').attr("type", "text");
        $('#verPswd').attr("background-color", "blue");
    });
    $('#verPswd').mouseup(function () {
        $('#cambiarPswd').attr("type", "password");
    });

    //FUNCIONES

    function toggleProfile($cancelEdit = false) {
        $profileEmail.toggle();
        $profilePasswd.toggle();
        $saveProfile.toggle();
        $cancelProfile.toggle();
        $editProfile.toggle();

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
        $pswdRegex = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,20}$/;
        // Comprobar password
        if (!$pswdRegex.test($('#cambiarPswd').val())) {
            $message += "La contraseña debe tener almenos una letra mínuscula, una máyuscula, contener un numero.\n";
        }
        // Comprobar email
        $emailRegex = /^.+\@.+\.[a-z]{2,}$/;
        if (!$emailRegex.test($('#cambiarEmail').val())) {
            $message += "¡El correo debe ser valido!\n";
        }
        return $message
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CREAR TORNEO
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    

    //ACCIONES

    $('#elegirCurso').change(function () {
        $('players').attr("display", "none");
        $('.players').toggle(200);
    });

    $('#sendNewTourn').click(function(){ 
        $validate = validateNewTournament();
        if ($validate.lengh != ""){
            $('#tournamentSubmit').click();
        }else{
            alertify.alert('Error al introducir los datos', message, function () {});
        }
    });
    
    //FUNCIONES
    
    function validateNewTournament(){
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
        if ($('select[name="userCourse"]').val() == null) {
            $message += "Elige un curso<br>";
        }
        if (!$dateCheck.test($('#myDate').val())) {
            $message += "Elige una fecha<br>";
        }
        return $message;
    }

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//GESTIONAR TORNEOS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $('.lateTourn').click(function () {
        $(this).closest('form').submit();
    });
    $('.prevTourn').click(function () {
        $btn = $('.prevTourn');
        alertify.confirm('Empezar torneo', 'Aun no es la fecha de inicio. ¿Estás seguro de que quieres empezar el torneo?', function (e) {
            if(e){
                $btn.closest('form').submit();
            }
        }
        , function () {
            alertify.error('Cancel')
        });
    });

    $('.editTourn').click(function () {

    });

    $("#tableTournaments").on('click', '.deleteTourn', function () {
        $(this).closest('form').submit();
        alertify.confirm("¿Estás seguro de que quieres eliminar el torneo? Todos los datos referentes al torneo se eliminarán.",
                function () {
                    alertify.success('Torneo eliminado');
                    $(this).closest('form').submit();
                },
                function () {
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
        // Validar que tpdas las rondas han sido seleccionadas
        if ($('.table.resTable tr.roundrow').length != $('.table.resTable tr .btnteam.selected').length){
            alertify.error("Debes seleccionar un equipo para cada ronda.");
            return false;
        }
        $teamsSelected = $('.btnteam.selected');
        $ts = [];

        $teamsSelected.each(function () {
            $id = $(this).attr('idteam');
            $ronda = $(this).closest('tr').attr('roundid');

            var obj = {
                round: $ronda,
                teamid: $id
            };
            $ts.push(obj);
        });
        $.get("index.php", {isAjaxReq: true, teamsSel: JSON.stringify($ts)})
            .done(function () {
                alertify.success("Datos guardados");
            })
            .fail(function () {
                alertify.error("error");
            });
    });

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//MI CURSO (GESTIÓN)
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    $('.studPermis').click(function () {
        $idStudent = $(this).closest('tr').find($('.IdAlumno'));
        $id = $idStudent.attr('id');
        var obj = {id:$id};
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
    
    $('.editStud').click(function () {
        $nombre = $(this).closest('tr').find($('.Nombre'));
        $apellido = $(this).closest('tr').find($('.Apellido'));
        $email = $(this).closest('tr').find($('.Email'));
        $usuario = $(this).closest('tr').find($('.Usuario_fk'));
        $curso = $('#thisCourse');
        genericDialog($('#modifyStudent')[0]);
        $('input[name="modifyName"]').val($nombre.attr('class').split(' ').pop());
        $('input[name="modifySurname"]').val($apellido.attr('class').split(' ').pop());
        $('input[name="modifyEmail"]').val($email.attr('class').split(' ').pop());
        $('input[name="modifyUser"]').val($usuario.attr('class').split(' ').pop());
        $('input[name="modifyCourse"]').val($curso.attr('class'));
    });
    
    $('.deleteStud').click(function(){
        $idStudent = $(this).closest('tr').find($('.IdAlumno'));
        $btn = $('.deleteStud');
        $tr = $(this).closest('tr');
        alertify.confirm('Eliminar usuario', '¿Estás seguro de que quieres eliminar los datos de este estudiante?', function (e) {
            if(e){
                $id = $idStudent.attr('id');
                var obj = {id:$id};
                $.get("index.php", {isAjaxReq: true, delStud: JSON.stringify(obj)})
                    .done(function(data){
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
    $('#addUser').click(function(){
        genericDialog($('#createStudent')[0]);
    });
    
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
});