<?php

require '../require/comun.php';
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$email = Leer::post("email");
$login = Leer::post("login");

if ($login != "") {
    $nombreUser = $modelo->get($login);
    if ($nombreUser->getLogin() != null) {
        $email = $nombreUser->getEmail();
        $id = md5($login . Configuracion::PEZARANA . $email);
        $enlace = "<a href='" . Entorno::getEnlaceCarpeta("viewRecupera.php?id=$id&login=$login") . "'>Click aqui para Cambiar contraseña</a>";
        $correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "recuperacion clave", $enlace, Configuracion::CLAVEGMAIL);
        if ($correo != "") {
            header("Location: ./viewError.php?error=No envia");
            exit();
        }
        header("Location: ./viewLogin.php?login=$login&error=Revisa el correo para cambiar la clave");
        exit();
    } else {
        header("Location: ./viewOlvido.php?error=Usuario no existe");
        exit();
    }
}

if ($email != "") {
    $parametros["email"] = $email;
    $filas = $modelo->getList("email=:email", $parametros);
    if (sizeof($filas) > 0) {
        $mensaje = "";
        foreach ($filas as $indice => $objeto) {
            $login = $objeto->getLogin();
            $email = $objeto->getEmail();
            $id = md5($login . Configuracion::PEZARANA . $email);
            $mensaje .= "Usuario: $login . <a href='" . Entorno::getEnlaceCarpeta("viewLogin.php?login=$login") . "'>Click aqui para Acceder</a><br/>"
                    . "<a href='" . Entorno::getEnlaceCarpeta("viewRecupera.php?id=$id&login=$login") . "'>Click aqui para Cambiar contraseña</a><br/>";
        }
        $correo = Correo::enviarGmail(Configuracion::ORIGENGMAIL, $email, "recuperacion clave", $mensaje, Configuracion::CLAVEGMAIL);
        if ($correo != "") {
            header("Location: ./viewError.php?error=No envia");
            exit();
        }        
        header("Location: ./viewLogin.php?error=Revisa el correo para ver el usuario o cambiar la clave");
        exit();
    } else {
        header("Location: ./viewOlvido.php?error=Email no existe");
        exit();
    }
}
$bd->closeConexion();
header("Location: ../index.php");