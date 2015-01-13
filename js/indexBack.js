window.addEventListener("load", function () {
    var banear = document.getElementsByClassName("banear");
    for (var i = 0; i < banear.length; i++) {
        banear[i].addEventListener("click", function (evento) {
            evento.preventDefault();
            var href = this.href;
            var nombre = this.getAttribute("data-login");
            swal({
                title: "¿Deseas banear la cuenta de "+ nombre +"?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                closeOnConfirm: true
            },
            function () {
                window.location = href;
            });
        });
    }
    var activar = document.getElementsByClassName("activar");
    for (var i = 0; i < activar.length; i++) {
        activar[i].addEventListener("click", function (evento) {
            evento.preventDefault();
            var href = this.href;
            var nombre = this.getAttribute("data-login");
            swal({
                title: "¿Deseas activar la cuenta de "+ nombre +"?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                closeOnConfirm: true
            },
            function () {
                window.location = href;
            });
        });
    }
    var desconectar = document.getElementById("desconectar");
    desconectar.addEventListener("click", function (evento) {
        evento.preventDefault();
        var href = this.href;
        swal({
            title: "¿Estas seguro de desconectar?",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Si",
            cancelButtonText: "No",
            closeOnConfirm: true
        },
        function () {
            window.location = href;
        });
    });

    var borrar = document.getElementsByClassName("borrar");
    for (var i = 0; i < borrar.length; i++) {
        borrar[i].addEventListener("click", function (evento) {
            evento.preventDefault();
            var href = this.href;
            var nombre = this.getAttribute("data-login");
            swal({
                title: "¿Deseas borrar la cuenta de "+ nombre +"?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Si",
                cancelButtonText: "No",
                closeOnConfirm: true
            },
            function () {
                window.location = href;
            });
        });
    }
});