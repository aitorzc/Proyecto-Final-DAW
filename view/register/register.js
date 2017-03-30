var alert = document.getElementsByClassName("alert-danger");

window.onload = function () {

    for (var i = 0; i < alert.length; i++) {

        alert[i].setAttribute("hidden", "hidden");
        alert[i].previousSibling.previousSibling.addEventListener("focusout", formValidate);
    }
    
}

function logValidate(){

    var nick = document.getElementById("nickLog");
    var pswd = document.getElementById("pswdLog");

    if(nick.value.length > 0 && pswd.value.length > 6){

        document.getElementById("sendLog").removeAttribute("disabled");

    }

}
function formValidate(){
    var nick = document.getElementById("nick");
    var email = document.getElementById("email");
    var pswd = document.getElementById("pswd");
    var pswd2 = document.getElementById("pswd2");
    var name = document.getElementById("nombre");
// Comprueba que empiece por cualquier carácter seguido de @ seguido de cualquier caracter, un punto y finalmente dos letras o más.
    var emailRegex = /^.+\@.+\.[a-z]{2,}$/;
// Comprueba que el nombre empiece por mayúscula seguido de minúsculas con carácteres de lengua española permitidos
    var nombreRegex = /^([A-Z]{1}[a-zñáéíóú]+[\s]*)+$/;
// Comprueba que el nick tenga un mínimo 4 carácteres y un máximo de 15
    var nickRegex = /^[a-z\d_]{4,15}$/i;
// Comprueba que la contraseña tenga almenos una letra mínuscula, una máyuscula, contener un numero y tener una longitud entre 8 y 20
    var pswdRegex = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,20}$/;

    if (nick.value.length != 0 && !(nickRegex.test(nick.value))) {
        
        alert[0].removeAttribute("hidden");

    }else{

        alert[0].setAttribute("hidden", "hidden");

    }
    if (name.value.length != 0 && !(nombreRegex.test(name.value))) {
        
        alert[1].removeAttribute("hidden");

    }else{

        alert[1].setAttribute("hidden", "hidden");

    }
    if (email.value.length != 0 && !(emailRegex.test(email.value))) {

        alert[2].removeAttribute("hidden");

    }else{

        alert[2].setAttribute("hidden", "hidden");

    }
    if (pswd.value.length != 0 && !(pswdRegex.test(pswd.value))) {
        
        return alert[3].removeAttribute("hidden");

    }else{

        alert[3].setAttribute("hidden", "hidden");
        
    }
    if (pswd.value != pswd2.value) {

        alert[4].removeAttribute("hidden");

    }else{

         alert[4].setAttribute("hidden", "hidden");

    }
    

}
