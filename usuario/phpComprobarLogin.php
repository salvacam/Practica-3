<?php
require '../require/comun.php';
header('Content-Type: text/plain');
$login = Leer::get("login");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
echo ($modelo->get($login)->getNombre() == null ? "Nombre de usuario valido" : "Nombre de usuario en uso");
