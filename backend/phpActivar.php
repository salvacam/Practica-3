<?php

require '../require/comun.php';
$sesion->admin("../index.php");
$login = Leer::get("login");

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$r = $modelo->activar($login);

$bd->closeConexion();
if ($r == 1) {
    header("Location:./index.php?mensaje=Usuario activado");
    exit();
} else {
    header("Location:./index.php?mensaje=No se ha podido activar al usuario");
}

