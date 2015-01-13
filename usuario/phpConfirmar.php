<?php
require '../require/comun.php';
$id = Leer::get("id");
$login = Leer::get("login");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$r = $modelo->activa($id, $login);
if ($r == 1) {
    header("Location:./viewLogin.php?login=$login");
} else {
    header("Location:./viewLogin.php");
}
