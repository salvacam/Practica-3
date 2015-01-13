<?php
require '../require/comun.php';
header('Content-Type: text/plain');
$email = Leer::get("email");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
echo ($modelo->getEmail($email)->getNombre() == null ? "Email no usado" : "Email ya en uso");
