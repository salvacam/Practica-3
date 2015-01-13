window.addEventListener("load", function () {
    var clave = document.getElementById("clave");
    var claveConfirmada = document.getElementById("claveConfirmada");
    var disponibleClave = document.getElementById("disponibleClave");
    var disponibleClaveConfirmada = document.getElementById("disponibleClaveConfirmada");

    var alta = document.getElementById("alta");
    alta.disabled = true;

    var claveValida = false;
    var claveValidaConfirmada = false;

    clave.addEventListener("blur", function () {
        disponibleClave.textContent = "";
        if (clave.value.length < 5 || clave.value.length > 10) {
            claveValida = false;
            disponibleClave.textContent = "Clave entre 5 y 10 caracteres";
        } else {
            claveValida = true;
        }
        if (claveValida && claveValidaConfirmada) {
            alta.disabled = false;
        } else {
            alta.disabled = true;
        }
    });

    claveConfirmada.addEventListener("keyup", function () {
        disponibleClaveConfirmada.textContent = "";
        if (claveConfirmada.value.length < 5 || clave.value.length > 10) {
            claveValidaConfirmada = false;
            disponibleClaveConfirmada.textContent = "Clave entre 5 y 10 caracteres";
        } else {
            if (claveConfirmada.value != clave.value) {
                claveValidaConfirmada = false;
                disponibleClaveConfirmada.textContent = "Las Claves no coinciden";
            } else {
                claveValidaConfirmada = true;
            }
        }
        if (claveValida && claveValidaConfirmada) {
            alta.disabled = false;
        } else {
            alta.disabled = true;
        }
    });
});