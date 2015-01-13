<?php
require '../require/comun.php';
$login = Leer::post("login");
$clave = Leer::post("clave");
$email = Leer::post("email");
$claveConfirmada = Leer::post("claveConfirmada");
$nombre = Leer::post("nombre");
$apellidos = Leer::post("apellidos");
if(!Validar::isAltaUsuario($login, $clave, $claveConfirmada, $nombre, $apellidos, $email)){    
    header ("Location: viewAlta.php?error=Datos no validos");
    exit();
}
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$nombreUser = new Usuario($login, $clave, $nombre, $apellidos, $email);
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
    if($correo != ""){
        header ("Location: viewError.php?login=$login");
        exit();    
    }
    header ("Location: viewBienvenida.php");
    exit;
}
header ("Location: viewAlta.php?error=No se ha podido crear el usuario");