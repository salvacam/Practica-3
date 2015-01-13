window.addEventListener("load", function () {
    var login = document.getElementById("login");
    var email = document.getElementById("email");
    var clave = document.getElementById("clave");
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

    var nombreUsuario = false;
    var emailValido = false;
    var claveValida = false;
    var claveValidaConfirmada = false;

    login.addEventListener("blur", function () {
        disponibleLogin.textContent = "";
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
                                nombreUsuario = true;
                            } else {
                                nombreUsuario = false;
                            }
                            if (nombreUsuario && emailValido && claveValida && claveValidaConfirmada) {
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
            nombreUsuario = false;
            alta.disabled = true;
        }
    });


    email.addEventListener("blur", function () {
        disponibleEmail.textContent = "";
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
                            if (nombreUsuario && emailValido && claveValida && claveValidaConfirmada) {
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
    });

    clave.addEventListener("blur", function () {
        disponibleClave.textContent = "";
        if (clave.value.length < 5 || clave.value.length > 10) {
            claveValida = false;
            disponibleClave.textContent = "Clave entre 5 y 10 caracteres";
        } else {
            claveValida = true;
        }
        if (nombreUsuario && emailValido && claveValida && claveValidaConfirmada) {
            alta.disabled = false;
        } else {
            alta.disabled = true;
        }
    });

    claveConfirmada.addEventListener("blur", function () {
        disponibleClaveConfirmada.textContent = "";
        if (claveConfirmada.value.length < 5 || claveConfirmada.value.length > 10) {
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
        if (nombreUsuario && emailValido && claveValida && claveValidaConfirmada) {
            alta.disabled = false;
        } else {
            alta.disabled = true;
        }
    });
    
    var isroot = document.getElementById("isroot");
    var rol1 = document.getElementById("rol1");
    var rol2 = document.getElementById("rol2");    
    var ayudaAdmin = document.getElementById("ayudaAdmin");
    
    isroot.addEventListener("change", function(){
        if(isroot.checked){
            rol2.removeAttribute("disabled");
            ayudaAdmin.textContent="";
        } else {
            if(rol2.checked){
                rol2.checked= false;
                rol1.checked= true;
            }
            rol2.setAttribute("disabled","");            
            ayudaAdmin.innerHTML="&nbsp;Activa root";
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