<?php

require '../require/comun.php';

if ($sesion->getAdmin() != null) {
    header("Location:./index.php");
}
$login = Leer::post("login");
$clave = Leer::post("clave");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

if ($modelo->isActivo($login, $clave) == 0 && $modelo->isActivo($login, $clave) != null) {
    header("Location:../usuario/viewAviso.php?login=$login");
    exit();
}
if ($modelo->isActivo($login, $clave) == -1 && $modelo->isActivo($login, $clave) != null) {
    header("Location:../usuario/viewBaneado.php");
    exit();
}
$nombreUser = $modelo->loginAdmin($login, $clave);
if ($nombreUser == false) {
    $sesion->cerrar();
    $bd->closeConexion();
    header("Location:viewLogin.php?error=Login y/o contraseña incorrecta");
    exit();
} else {
    $sesion->setUsuario($modelo->login($login, $clave));    
    $sesion->setAdmin($nombreUser);
    $nombreRoot = $modelo->loginRoot($login, $clave);
    if($nombreRoot != false){
        $sesion->setRoot($nombreRoot);
    }
    $modeloLogin = new ModeloLogin($bd);
    $ip = Entorno::getIpCliente();
    $id = $modelo->getId($login);
    $browser = Entorno::getNavegadorCliente();
    $login = new Login(null, $id[0], null, $ip, $browser);
    $modeloLogin->add($login);
    $bd->closeConexion();
    header("Location:./index.php");
}
