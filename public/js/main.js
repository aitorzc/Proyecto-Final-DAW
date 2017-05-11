$(function() {
    var btnMenu = $("#btnMenu");
    var btnMenu2 = $("#btnMenu2");
    var sidenav = $("#sidenav");
    
    btnMenu.click(function(){
        if($("#btnMenu span:first").attr("class") == "glyphicon glyphicon-menu-hamburger"){
            sidenav.css("width", "300px"); 
            $("#btnMenu span:first").attr("class", "glyphicon glyphicon-menu-left");
        }else{
            sidenav.css("width", "0");
            $("#btnMenu span:first").attr("class", "glyphicon glyphicon-menu-hamburger");
        }
    });
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//MODIFICAR PERFIL
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    

// Funcion para poder editar perfil
    $('#btnEditProfile').click(function(){
        // Visibilizar iconos, inputs, botones para editar perfil
        $('.editEmail').toggle();
        $('.editPasswd').toggle();
        $('#btnSaveProfile').toggle();
        $('#btnCancelProfile').toggle();
        $('#btnEditProfile').toggle();
        // Funciones editar imagen
        $('.imgContainer').mouseover(function(){
            $('#imgProfile').css('opacity', '0.7');
            $('#fadeEffect').css('opacity', '1');
        });
        $('.imgContainer').mouseout(function(){
            $('#imgProfile').css('opacity', '1');
            $('#fadeEffect').css('opacity', '0');
        });
    });
    
    // Funcion para cancelar editar perfil
    $('#btnCancelProfile').click(function(){
        // Visibilizar iconos, inputs, botones para editar perfil
        $('.editEmail').toggle();
        $('.editPasswd').toggle();
        $('#btnSaveProfile').toggle();
        $('#btnCancelProfile').toggle();
        $('#btnEditProfile').toggle();
        // Funciones editar imagen
        $('.imgContainer').mouseover(function(){
            $('#imgProfile').css('opacity', '0.7');
            $('#fadeEffect').css('opacity', '1');
        });
        $('.imgContainer').mouseout(function(){
            $('#imgProfile').css('opacity', '1');
            $('#fadeEffect').css('opacity', '0');
        });
        $('.editPasswd').val("");
        $('.editEmail').val($('.editEmail').val());
    });
    
    // Funcion guardar perfil
    $('#btnSaveProfile').click(function(){
        var message = "";
        var throwMessage = false;
        // Comprobar contraseña
        var pswdRegex = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,20}$/;
        
        if(pswdRegex.test($('#cambiarPswd').val())) {
            console.log("bien");
            console.log($('#cambiarPswd').val());
        }else{
            message+="La contraseña debe tener almenos una letra mínuscula, una máyuscula, contener un numero.\n";
            throwMessage = true;
        }
        // Comprobar email
        var emailRegex = /^.+\@.+\.[a-z]{2,}$/;
        
        if(emailRegex.test($('#cambiarEmail').val())) {
            console.log("bien");
            console.log($('#cambiarEmail').val());
        }else{
           message+="¡El correo debe ser valido!\n";
           throwMessage = true;
        }
        
        if(throwMessage == false){
            alert("Guardado");
        }else{
            alert(message);
        }
        // TODO: Comprobar imagen
    });
    
    //Comprobar contraseña
    $('#checkPswd').click(function(){
        var pswdRegex = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,20}$/;
        if (pswd.value.length != 0 && !(pswdRegex.test(pswd.value))) {
            return true
        }
    });
    // Efecto para ver contraseña
    $('#verPswd').mousedown(function(){
        $('#cambiarPswd').attr("type", "text");
        $('#verPswd').attr("background-color", "blue");
    });
    $('#verPswd').mouseup(function(){
        $('#cambiarPswd').attr("type", "password");
    });
    
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//CREAR TORNEO
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////    
    
    $('#elegirCurso').change(function(){
        //TODO: Arreglar funcion elegir curso y mostrar alumnos
        var pos = $('#elegirCurso').val();
        console.log($('#elegirCurso').val());
//        if($('.players').eq(0).attr("display") != "none"){
//            $('.players').eq(0).toggle();
//        }else if($('.players').eq(1).attr("display") != "none"){
//            $('.players').eq(1).toggle();
//        }else if($('.players').eq(2).attr("display") != "none"){
//            $('.players').eq(2).toggle();
//        }else if($('.players').eq(3).attr("display") != "none"){
//            $('.players').eq(3).toggle();
//        }
        $('players').attr("display", "none");
        $('.players').eq(pos).toggle(200);
    });
//    $('#players').change(function(){
//        
//        for(var i = 0; i < $('#players').length;i++){
//            if(i%1==0){
//                $("#playersList").append('<span class="label label-default">'+ $('#players').val()[i] +'</span><br>');
//            }else{
//                $("#playersList").append('<span class="label label-default">'+ $('#players').val()[i] +'</span>');
//            }
//        }
//        
//    });

    $('#sendNewTourn').click(function(){
        
        ok = true;
        message = "";
        dateCheck = /^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
        
        if($('select[name="sportName"]').val() == null){
            ok = false;
            message+= "Elige un deporte\n";
        }
        if($('input[name="nameTournament"]').val() == null){
            ok = false;
            message+= "Elige un nombre para el torneo\n";
        }
        if($('select[name="gameType"]').val() == null){
            ok = false;
            message+= "Elige el tipo de agrupación\n";
        }
        if($('select[name="userCourse"]').val() == null){
            ok = false;
            message+= "Elige un curso\n";
        }
        if(!dateCheck.test($('#myDate').val())){
            ok = false;
            message+= "Elige una fecha\n";
        }
        if(ok == true){
            $('#tournamentSubmit').click();
        }else{
            alert(message);
        }
    });
    $('#profile').popover();
});

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//GESTIONAR TORNEOS
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

$('.lateTourn').click(function(){
    
});
$('.prevTourn').click(function(){
    console.log("entre");
    confirm("Aun no es la fecha de inicio. ¿Estás seguro de que quieres empezar el torneo?");
});
$('.editTourn').click(function(){
    
});
$('.deleteTourn').click(function(){
    confirm("¿Estás seguro de que quieres eliminar el torneo? Todos los datos referentes al torneo se eliminarán.");
});