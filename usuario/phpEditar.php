<?php

require '../require/comun.php';
$sesion->autentificado("viewLogin.php");
$nombreUser = $sesion->getUsuario();
$login = Leer::post("login");
$clave = Leer::post("clave");
$claveNueva = Leer::post("claveNueva");
$claveConfirmada = Leer::post("claveConfirmada");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
if ($claveNueva != "" || $claveNueva != null) {
    if (!Validar::isAltaUsuario($login, $claveNueva, $claveConfirmada, $nombre, $apellidos, $email)) {
        header("Location: viewEdit.php?error=Datos no validos");
        exit();
    }
    $cambioDeClave = true;
} else {
    if (!Validar::isAltaUsuarioSinClave($login, $nombre, $apellidos, $email)) {
        header("Location: viewEdit.php?error=Datos no validos");
        exit();
    }
    $cambioDeClave = false;
}

$nuevoUsuario = new Usuario($login, $claveNueva, $nombre, $apellidos, $email);
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$cambioDeCorreo = $email != $nombreUser->getEmail();
if ($cambioDeClave) {
    $r = $modelo->editConClave($nuevoUsuario, $nombreUser->getLogin(), $clave);
} else {
    $r = $modelo->editSinClave($nuevoUsuario, $nombreUser->getLogin(), $clave);
}

$usuarioOrig = $modelo->get($login);
//subir archivos
$cambiaFoto = false;
$borradoFoto = false;
$aux = $modelo->login($login, $clave);
if ($aux) {
    $borrarFoto = Leer::post("borrarFoto");
    if ($borrarFoto == "on") {
        //borrar archivo
        $ruta = "../usuarios/" . $usuarioOrig->getId();
        $directorio = opendir($ruta);
        while ($archivo = readdir($directorio)) {
            if ($archivo != ".." && $archivo != ".") {
                unlink($ruta . DIRECTORY_SEPARATOR . $archivo);
            }
        }
        $borradoFoto = true;
    }
    if ($_FILES["archivos"]["name"] != NULL) {
        //borrar archivo
        $ruta = "../usuarios/" . $usuarioOrig->getId();
        $directorio = opendir($ruta);
        while ($archivo = readdir($directorio)) {
            if ($archivo != ".." && $archivo != ".") {
                unlink($ruta . DIRECTORY_SEPARATOR . $archivo);
            }
        }

        $subir = new SubirArray("archivos");
        $subir->setAccion("2"); //reemplazar
        $subir->setDestino($ruta);
        $subir->setNombre();
        $subir->setMaximo("2097152"); //0.5 megas "2097152"
        $subir->addTipo("image");
        $subir->subir();
        $cambioFoto = true;
    }
}
if ($cambioDeCorreo && $r > 0) {
    $r = $modelo->desactivar($nuevoUsuario->getLogin());
    $sesion->cerrar();
    $id = md5($email . Configuracion::PEZARANA . $login);
    $enlace = "Click aqui: <a href='" . Entorno::getEnlaceCarpeta("phpconfirmar.php?id=$id") . "'>Validar cuenta</a>";
    $correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "alta en web", $enlace, Configuracion::CLAVEGMAIL);
    if ($correo != "") {
        header("Location: viewError.php?login=$login");
        exit();
    }
    header("Location:./viewLogin.php?login=$login&error=Consulta el email para activar la cuenta");
    exit();
}
$sesion->setUsuario($usuarioOrig);
$bd->closeConexion();
if ($r > 0 || $cambioFoto || $borradoFoto) {
    header("Location:../index.php?mensaje=Cuenta Editada");
    exit();
} else {
    header("Location: ./viewEdit.php?error=No se ha podido editar");
    exit();
}
    