var btnMenu = document.getElementById("btnMenu");
var sidenav = document.getElementById("sidenav");
//Abrir el nav lateral
function openSidenav(){

    sidenav.style.width = "12vw";
    btnMenu.firstChild.className = "glyphicon glyphicon-menu-left";
    btnMenu.removeAttribute("onclick");
    btnMenu.setAttribute("onclick", "closeSidenav()");
    
}
//Cerrar el nav lateral
function closeSidenav(){

    sidenav.style.width = "0";
    btnMenu.firstChild.className = "glyphicon glyphicon-menu-hamburger";
    btnMenu.removeAttribute("onclick");
    btnMenu.setAttribute("onclick",  "openSidenav()");

}
