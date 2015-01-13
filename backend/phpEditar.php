<?php

require '../require/comun.php';
$sesion->root("index.php");
$loginpk = Leer::post("loginpk");
$login = Leer::post("login");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$email = Leer::post("email");
$isactivo = Leer::post("isactivo");
if ($isactivo != "on") {
    $isactivo = 0;
} else {
    $isactivo = 1;
}
$isroot = Leer::post("isroot");
if ($isroot != "on") {
    $isroot = 0;
} else {
    $isroot = 1;
}
$rol = Leer::post("rol");
$roles = ["usuario", "administrador"];
if (!Validar::isAltaUsuarioBackSinClave($login, $nombre, $apellidos, $email, $isactivo, $isroot, $rol, $roles)) {
    header("Location: viewEdit.php?login=$loginpk&error=Datos no validos");
    exit();
}
$nuevoUsuario = new Usuario($login, null, $nombre, $apellidos, $email, null, $isactivo, $isroot, $rol);
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$nombreUser = $modelo->get($loginpk);
$cambioDeCorreo = $email != $nombreUser->getEmail();
$editarLogin = false;
$editarEmail = false;
if ($login != $nombreUser->getLogin()) {
    $editarLogin = true;
}
if ($email != $nombreUser->getEmail()) {
    $editarEmail = true;
}
if ($editarLogin) {
    if ($editarEmail) {
        $r = $modelo->editSinClaveBackLoginEmail($nuevoUsuario, $loginpk); //edit login y email
    } else {
        $r = $modelo->editSinClaveBackLogin($nuevoUsuario, $loginpk); //edit login
    }
} else {
    if ($editarEmail) {
        $r = $modelo->editSinClaveBackEmail($nuevoUsuario, $loginpk); //edit email
    } else {
        $r = $modelo->editSinClaveBack($nuevoUsuario, $loginpk); //edit normal
    }
}

$usuario = $sesion->getUsuario();
$usuarioOrig = $modelo->get($loginpk);
$cambiaFoto = false;
$borradoFoto = false;
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
//subir archivos
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
    $subir->setMaximo("2097152"); //0.5 megas "2097152"; poner 200kb
    $subir->addTipo("image");
    $subir->subir();
    $cambiaFoto = true;
}

if ($loginpk == $usuario->getLogin()) {
    $nuevoUsuario = $modelo->get($usuario->getLogin());
    $sesion->setUsuario($nuevoUsuario);
}

$bd->closeConexion();
if ($r > 0 || $cambiaFoto || $borradoFoto) {
    header("Location:./index.php?mensaje=Cuenta Editada");
    exit();
} else {
    header("Location: ./viewEdit.php?login=$loginpk&error=No se ha podido editar");
    exit();
}