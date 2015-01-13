window.addEventListener("load", function () {
    var login = document.getElementById("login");
    var loginpk = login.value;
    var email = document.getElementById("email");
    var emailpk = email.value;
    var clave = document.getElementById("clave");
    var claveNueva = document.getElementById("claveNueva");
    var claveConfirmada = document.getElementById("claveConfirmada");
    var disponibleLogin = document.getElementById("disponibleLogin");
    var disponibleEmail = document.getElementById("disponibleEmail");
    var disponibleClave = document.getElementById("disponibleClave");
    var disponibleClaveConfirmada = document.getElementById("disponibleClaveConfirmada");

    var limpiar = document.getElementById("limpiar");
    limpiar.addEventListener("click", function reset(evento) {
        evento.preventDefault();
        swal({
            title: "¿Estas seguro de limpiar?",
            text: "Si limpia perdera todos los datos",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: true
        },
        function () {
            document.getElementById("formAlta").reset();
        });
    });

    var alta = document.getElementById("alta");
    alta.disabled = true;

    var loginValido = true;
    var emailValido = true;
    var claveAnterior = false;
    var claveValida = true;
    var claveValidaConfirmada = true;

    login.addEventListener("change", function () {
        disponibleLogin.textContent = "";
        if (login.value != loginpk) {
            if (login.value.length > 4 && login.value.length < 11) {
                var peticionAsincrona;
                if (window.XMLHttpRequest) {
                    peticionAsincrona = new XMLHttpRequest();
                    peticionAsincrona.open("GET", "../usuario/phpComprobarLogin.php?login=" + encodeURIComponent(login.value), true);
                    peticionAsincrona.onreadystatechange = function () {
                        if (peticionAsincrona.readyState == 4) {
                            if (peticionAsincrona.status == 200) {
                                var respuesta = peticionAsincrona.responseText;
                                disponibleLogin.textContent = respuesta;
                                if (respuesta.indexOf("valido") >= 0) {
                                    loginValido = true;
                                } else {
                                    loginValido = false;
                                }
                                if (loginValido && emailValido && claveValida && claveValidaConfirmada && claveAnterior) {
                                    alta.disabled = false;
                                } else {
                                    alta.disabled = true;
                                }
                            }
                        }
                    }
                    peticionAsincrona.send();
                }
            } else {
                disponibleLogin.textContent = "Login entre 5 y 10 carácteres";
                loginValido = false;
                alta.disabled = true;
            }
        } else {
            loginValido = true;
            if (loginValido && emailValido) {
                alta.disabled = false;
            } else {
                alta.disabled = true;
            }
        }
    });

    email.addEventListener("change", function () {
        disponibleEmail.textContent = "";
        if (email.value != emailpk) {
            if (email.value != "") {
                var peticionAsincrona;
                if (window.XMLHttpRequest) {
                    peticionAsincrona = new XMLHttpRequest();
                    peticionAsincrona.open("GET", "../usuario/phpComprobarEmail.php?email=" + encodeURIComponent(email.value), true);
                    peticionAsincrona.onreadystatechange = function () {
                        if (peticionAsincrona.readyState == 4) {
                            if (peticionAsincrona.status == 200) {
                                var respuesta = peticionAsincrona.responseText;
                                disponibleEmail.textContent = respuesta;
                                if (respuesta.indexOf("no") >= 0) {
                                    emailValido = true;
                                } else {
                                    emailValido = false;
                                }
                                if (loginValido && emailValido && claveValida && claveValidaConfirmada && claveAnterior) {
                                    alta.disabled = false;
                                } else {
                                    alta.disabled = true;
                                }
                            }
                        }
                    }
                    peticionAsincrona.send();
                }
            } else {
                disponibleEmail.textContent = "Introduce email";
                emailValido = false;
                alta.disabled = true;
            }
        } else {
            emailValido = true;
            if (loginValido && emailValido) {
                alta.disabled = false;
            } else {
                alta.disabled = true;
            }
        }
    });

    clave.addEventListener("keypress", function () {
        if (clave.value.length > 0) {
            claveAnterior = true;
        } else {
            claveAnterior = false;
        }
        if (loginValido && emailValido && claveValida && claveValidaConfirmada && claveAnterior) {
            alta.disabled = false;
        } else {
            alta.disabled = true;
        }
    });

    claveNueva.addEventListener("change", function () {
        disponibleClave.textContent = "";
        if (claveNueva.value.length > 0) {
            if (claveNueva.value.length < 5 || claveNueva.value.length > 10) {
                claveValida = false;
                disponibleClave.textContent = "Clave entre 5 y 10 caracteres";
            } else {
                claveValida = true;
            }
        }
        if (loginValido && emailValido && claveValida && claveValidaConfirmada && claveAnterior) {
            alta.disabled = false;
        } else {
            alta.disabled = true;
        }
    });

    claveConfirmada.addEventListener("change", function () {
        disponibleClaveConfirmada.textContent = "";
        if (clave.value.length > 0) {
            if (claveConfirmada.value.length < 5 || claveConfirmada.value.length > 10) {
                claveValidaConfirmada = false;
                disponibleClaveConfirmada.textContent = "Clave entre 5 y 10 caracteres";
            } else {
                if (claveConfirmada.value != claveNueva.value) {
                    claveValidaConfirmada = false;
                    disponibleClaveConfirmada.textContent = "Las Claves no coinciden";
                } else {
                    claveValidaConfirmada = true;
                }
            }
        }
        if (loginValido && emailValido && claveValida && claveValidaConfirmada && claveAnterior) {
            alta.disabled = false;
        } else {
            alta.disabled = true;
        }
    });

    document.getElementById('archivos').addEventListener('change', mostrarArchivos, false);

    function mostrarArchivos(evt) {
        var files = evt.target.files; // FileList object
        var lista = document.getElementById('list');
        lista.innerHTML = "";
        // Loop through the FileList and render image files as thumbnails.
        for (var i = 0, f; f = files[i]; i++) {

            // Only process image files.
            if (!f.type.match('image.*')) {
                continue;
            }

            var reader = new FileReader();

            // Closure to capture the file information.
            reader.onload = (function (theFile) {
                return function (e) {
                    // Render thumbnail.
                    var span = document.createElement('span');
                    span.innerHTML = ['<img class="thumb" src="', e.target.result,
                        '" title="', escape(theFile.name), '"/>'].join('');
                    lista.insertBefore(span, null);
                };
            })(f);

            // Read in the image file as a data URL.
            reader.readAsDataURL(f);
        }
    }
});