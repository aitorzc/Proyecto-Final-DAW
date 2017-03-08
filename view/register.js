function formValidate(){
    var nick = document.getElementById("nick");
    var email = document.getElementById("email");
    var pswd = document.getElementById("pswd");
    var pswd2 = document.getElementById("pswd2");
    var name = Document.getElementById("nombre");
// Comprueba que empiece por cualquier carácter seguido de @ seguido de cualquier caracter, un punto y finalmente dos letras o más.
    var emailRegex = /^.+\@.+\.[a-z]{2,}$/;
// Comprueba que el nombre empiece por mayúscula seguido de minúsculas con carácteres de lengua española permitidos
    var nombreRegex = /^([A-Z]{1}[a-zñáéíóú]+[\s]*)+$/;
// Comprueba que el nick tenga un mínimo 4 carácteres y un máximo de 15
    var nickRegex = /^[a-z\d_]{4,15}$/i;
// Comprueba que la contraseña tenga almenos una letra mínuscula, una máyuscula, contener un numero y tener una longitud entre 8 y 20
    var pswdRegex = /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/;  

    if (emailRegex.test(email.value)) {

        alert("bien");

    }

}