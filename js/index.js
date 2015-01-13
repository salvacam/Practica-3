window.addEventListener("load", function () {
    var borrar = document.getElementById("borrar");
    var href = borrar.href;
    borrar.addEventListener("click", function (evento) {
        evento.preventDefault();
        swal({
            title: "¿Estas seguro desactivar la cuenta?",
            text: "Si desactiva la cuenta debera volver a activar la cuenta para acceder.Podra usar el mismo usuario y email.",
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
});