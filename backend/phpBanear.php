<?php

require '../require/comun.php';
$sesion->admin("../index.php");
$login = Leer::get("login");

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$r = $modelo->banear($login);

$usuario = $sesion->getUsuario();
if ($login == $usuario->getLogin()) {
    $modeloUser = new ModeloUsuario($bd);
    $nuevoUsuario = $modeloUser->get($login);
    $sesion->setUsuario($nuevoUsuario);
}
$bd->closeConexion();
if ($r == 1) {
    header("Location:./index.php?mensaje=Usuario baneado");
    exit();
} else {
    header("Location:./index.php?mensaje=No se pudo banear");
}

