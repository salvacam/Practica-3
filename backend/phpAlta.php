<?php
require '../require/comun.php';
$sesion->root("../index.php");
$login = Leer::post("login");
$clave = Leer::post("clave");
$email = Leer::post("email");
$claveConfirmada = Leer::post("claveConfirmada");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
$isactivo = Leer::post("isactivo");
if($isactivo != "on"){
    $isactivo = 0;
} else {
    $isactivo = 1;
}
$isroot = Leer::post("isroot");
if($isroot != "on"){
    $isroot = 0;
} else {
    $isroot = 1;
}
$rol = Leer::post("rol");
//$roles = ["usuario","administrador"];
$roles = array("usuario","administrador");
if(!Validar::isAltaUsuarioBack($login, $clave, $claveConfirmada, $nombre, 
        $apellidos, $email, $isactivo, $isroot, $rol, $roles)){    
    header ("Location: viewAlta.php?error=Datos no validos");
    exit();
}

$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$nombreUser = new Usuario($login, $clave, $nombre, $apellidos, $email, null, $isactivo, $isroot, $rol);
$r = $modelo->add($nombreUser);

$ruta = "../usuarios/" . $r;
if ($r > 0) {
    mkdir($ruta, Configuracion::PERMISOS);
}

//subir archivos
if ($_FILES["archivos"]["name"] != NULL) {
    $subir = new SubirArray("archivos");
    $subir->setAccion("1"); //renombra
    $subir->setDestino($ruta);
    $subir->setNombre();
    $subir->setMaximo("2097152"); //0.5 megas "2097152"
    $subir->addTipo("image");
    $subir->subir();
}

$bd->closeConexion();
if($r > 0){
    $id = md5($email.Configuracion::PEZARANA.$login);    
    $enlace = urldecode("<a href='".Entorno::getEnlaceCarpeta("phpConfirmar.php?id=$id&login=$login")."'>Click aqui para Validar cuenta</a>"); 
    $correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "alta en web", $enlace, Configuracion::CLAVEGMAIL);      
    header ("Location: index.php?mensaje=Usuario creado");
    exit;
}
header ("Location: viewAlta.php?error=No se ha podido crear el usuario");

