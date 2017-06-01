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

$('#sendMail').click(function(){
    console.log("entra");
    $message = $('#message').val();
    $headers = "From: " + $('#headers').val();
    $subject = $('name').val();
    var obj = {
        subject:$subject,
        headers:$headers,
        message:$message
    };
    $.get("index.php", {isAjaxReq: true, sendMail: JSON.stringify(obj)})
        .done(function(){
            alertify.success("Mensaje enviado");
        })
        .fail(function() {
            alertify.error("Error al enviar mensaje");
        });
});