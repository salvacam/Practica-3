<?php

require '../require/comun.php';
$id = Leer::post("id");
$login = Leer::post("login");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$r = $modelo->cambiarClave($login, $id);
if ($r <= 0) {
    $bd->closeConexion();
    header("Location:../index.php");
    exit();
}
$nombreUser = $modelo->get($login);

$clave = Leer::post("clave");
$claveConfirmada = Leer::post("claveConfirmada");

//validar php
if (!Validar::isClave($clave) || $clave != $claveConfirmada) {
    header("Location: ../index.php");
    exit();
}
$nuevoUsuario = new Usuario($login, $clave, $nombreUser->getNombre(), $nombreUser->getApellidos(), $nombreUser->getEmail());
$bd = new BaseDatos();

$r = $modelo->editConClave($nuevoUsuario, $nombreUser->getLogin(), $nombreUser->getClave());
$bd->closeConexion();
header("Location:viewLogin.php?login=$login");
