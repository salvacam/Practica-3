<?php

require '../require/comun.php';
if ($sesion->getUsuario() != null) {
    header("Location:../index.php");
}
$login = Leer::post("login");
$clave = Leer::post("clave");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
if ($modelo->isActivo($login, $clave) == 0 && $modelo->isActivo($login, $clave) != null) {
    header("Location:viewAviso.php?login=$login");
    exit();
}
if ($modelo->isActivo($login, $clave) == -1 && $modelo->isActivo($login, $clave) != null) {
    header("Location:viewBaneado.php");
    exit();
}
$nombreUser = $modelo->login($login, $clave);
if ($nombreUser == false) {
    $sesion->cerrar();
    $bd->closeConexion();
    header("Location:viewLogin.php?error=Login y/o contraseña incorrecta");
    exit();
} else {
    $nombreUser->setId($modelo->getId($login));
    $sesion->setUsuario($nombreUser);
    $modeloLogin = new ModeloLogin($bd);
    $ip = Entorno::getIpCliente();
    $id = $modelo->getId($login);
    $browser = Entorno::getNavegadorCliente();
    $login = new Login(null, $id[0], null, $ip, $browser);
    $modeloLogin->add($login);
    $bd->closeConexion();
    header("Location:../index.php");
}
