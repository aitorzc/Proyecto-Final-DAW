
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
});