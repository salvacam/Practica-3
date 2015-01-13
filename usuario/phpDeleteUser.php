<?php

require '../require/comun.php';
$sesion->autentificado("./viewLogin.php");
$nombreUser = $sesion->getUsuario();
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$r = $modelo->desactivar($nombreUser->getLogin());
$sesion->cerrar();
header("Location:../index.php");
