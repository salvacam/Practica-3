<?php

require '../require/comun.php';
$sesion->root("../index.php");
$login = Leer::get("login");
$email = Leer::get("email");

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$usuarioOrig = $modelo->get($login);
$id = $usuarioOrig->getId();
$num = 0;
$r = $modelo->borrar($login, $email, $num);
while ($r < 1 && $num < 99) {
    $num++;
    $r = $modelo->borrar($login, $email, $num);
}
$usuario = $sesion->getUsuario();
if ($login == $usuario->getLogin()) {
    $sesion->cerrar();
}

if ($r == 1) {
    $ruta = "../usuarios/" . $id;
    $directorio = opendir($ruta);
    while ($archivo = readdir($directorio)) { 
        if ($archivo != ".." && $archivo != ".") {
            unlink($ruta . DIRECTORY_SEPARATOR . $archivo);
        }
    }
    $bd->closeConexion();
    header("Location:./index.php?mensaje=Usuario borrado");
    exit();
} else {
    $bd->closeConexion();
    header("Location:./index.php?mensaje=No se pudo borrar");
}