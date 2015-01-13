window.addEventListener("load", function () {
    var login = document.getElementById("login");
    var loginpk = login.value;
    var email = document.getElementById("email");
    var emailpk = email.value;
    var disponibleLogin = document.getElementById("disponibleLogin");
    var disponibleEmail = document.getElementById("disponibleEmail");

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
    alta.disabled = false;

    var loginValido = true;
    var emailValido = true;

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
                                if (loginValido && emailValido) {
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
                                if (loginValido && emailValido) {
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

    var isroot = document.getElementById("isroot");
    var rol1 = document.getElementById("rol1");
    var rol2 = document.getElementById("rol2");
    var ayudaAdmin = document.getElementById("ayudaAdmin");

    isroot.addEventListener("change", function () {
        if (isroot.checked) {
            rol2.removeAttribute("disabled");
            ayudaAdmin.textContent = "";
        } else {
            if (rol2.checked) {
                rol2.checked = false;
                rol1.checked = true;
            }
            rol2.setAttribute("disabled", "");
            ayudaAdmin.innerHTML = "&nbsp;Activa root";
        }
    });
});