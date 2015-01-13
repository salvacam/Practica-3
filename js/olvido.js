window.addEventListener("load", function () {
    var login = document.getElementById("login");
    var email = document.getElementById("email");
    var enviar = document.getElementById("enviar");
    
    enviar.addEventListener("click", function (evento) {
        if(login.value.length == 0 && email.value.length == 0){
            sweetAlert("Introduce login o email");
            evento.preventDefault();
        }
        
    });
});


