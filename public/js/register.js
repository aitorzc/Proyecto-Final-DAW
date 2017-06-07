var alert = document.getElementsByClassName("alert-danger");

window.onload = function () {

    for (var i = 0; i < alert.length; i++) {

        alert[i].setAttribute("hidden", "hidden");
        alert[i].previousSibling.previousSibling.addEventListener("focusout", formValidate);
    }
    
    //Validador del login

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
    
}
function logValidate(){

    var nick = document.getElementById("nickLog");
    var pswd = document.getElementById("pswdLog");

    if(nick.value.length > 0 && pswd.value.length > 6){
        document.getElementById("sendLog").removeAttribute("disabled");
    }
}