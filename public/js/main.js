
// Calendario para elegir fecha de torneo
/*$(function () {
    $('#datetimepicker').datetimepicker();
});*/

$(function() {
    var btnMenu = $("#btnMenu");
    var btnMenu2 = $("#btnMenu2");
    var sidenav = $("#sidenav");
    
    btnMenu.click(function(){
        if($("#btnMenu span:first").attr("class") == "glyphicon glyphicon-menu-hamburger"){
            sidenav.css("width", "12vw"); 
            $("#btnMenu span:first").attr("class", "glyphicon glyphicon-menu-left");
        }else{
            sidenav.css("width", "0");
            $("#btnMenu span:first").attr("class", "glyphicon glyphicon-menu-hamburger");
        }
    });

    $('#elegirCurso').change(function(){
        //TODO: Arreglas funcion elegir curso y mostrar alumnos
        var pos = $('#elegirCurso').val();
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
        console.log($('.players'));
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
        
        var ok = true;
        message = "";
        dateCheck = /^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/;
        
        if($('select[name="sportName"]').val() == null){
            ok = false;
            message+= "Elige un deporte\n";
        }
        if($('select[name="gameMode"]').val() == null){
            ok = false;
            message+= "Elige un modo de juego\n";
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
    $('#editProfile').click(function(){
        $('#editEmail').toggle();
    });
});
