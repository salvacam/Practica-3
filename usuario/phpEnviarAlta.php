<?php

require '../require/comun.php';
$login = Leer::get("login");

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$nombreUser = $modelo->get($login);
$email = $nombreUser->getEmail();

$id = md5($email . Configuracion::PEZARANA . $login);
$enlace = urldecode("<a href='" . Entorno::getEnlaceCarpeta("phpConfirmar.php?id=$id&login=$login") . "'>Click aqui para Validar cuenta</a>");
$correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "alta en web", $enlace, Configuracion::CLAVEGMAIL);
if ($correo != "") {
    header("Location: viewError.php?login=$login");
    exit();
}
$direccion = Entorno::getEnlaceCarpeta("phpConfirmar.php?id=$id&login=$login"); // quitar despues
header("Location: viewBienvenida.php?direccion=$direccion"); //quitar direccion
exit;
