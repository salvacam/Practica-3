window.addEventListener("load", function() {
    var modificar = document.getElementById("modificar");
    var login = document.getElementById("login");
    var clave = document.getElementById("clave");
    var claveNueva = document.getElementById("claveNueva");
    var claveConfirmada = document.getElementById("claveConfirmada");
    modificar.addEventListener("click", validar);


    function validar() {
        var error = "";
        if (login.value.lenght < 1) {
            error += "el login debe existir\n";
        }
        if (claveNueva.value.lenght > 1 || claveConfirmada.value.lenght > 1) {
            if(clave.value < 1){                
                error += "si cambia la clave escribe la anterior\n";
            }
            if(claveNueva.value != claveConfirmada.value){
                error += "las nuevas claves no coinciden\n";                
            }
        }
    }

});



