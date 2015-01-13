<?php
require './require/comun.php';
$sesion->autentificado("./usuario/viewLogin.php");
$nombreUser = $sesion->getUsuario();
$id = $nombreUser->getId();
$mensaje = Leer::get("mensaje");
$ruta = "./usuarios/" . $id[0];
$directorio = opendir($ruta);
$imagen = "";
while ($archivo = readdir($directorio)) { 
    if ($archivo != ".." && $archivo != ".") {
        $imagen = $archivo;
    }
}
?>
<!doctype html>
<html lang="es">

    <head>
        <title>Gestion de Usuarios</title>
        <meta charset="utf-8">
        <script src="./js/terceros/sweet-alert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="./css/terceros/sweet-alert.css">
        <link rel="stylesheet" href="./font/font.css">
        <link rel="stylesheet" href="./css/front-end.css">
        <link rel="shortcut icon" href="./img/favicon.ico">
        <script src="./js/index.js"></script>
    </head>

    <body>
        <div class="vertical-container">	  
            <div id="contenedor">
                <?php include "./include/headerIndex.php"; ?>
                <div id="formulario">
                    <span class="ayuda center"><?php echo $mensaje; ?></span>
                    <br/>
                    <span id="titulo">
                        <img alt="usuario" src="./img/usuario.png">
                        Hola
                    </span>
                    <p class="center"><b class="mayuscula"><?php echo $nombreUser->getLogin(); ?></b>
                        estas conectado</p>
                    <div id="imagen-principal">
                        <?php
                        if ($imagen != "") {
                            echo "<img src='$ruta/$imagen' alt='avatar' id='imgP'/>";
                        }
                        ?>
                    </div>
                    <br/>
                    <a class="fondo" href="./usuario/phpLogout.php">Desconectarse</a>
                    <br/>
                    <br/>
                    <a class="fondo" href="./usuario/viewEdit.php">Editar Cuenta</a>
                    <br/>
                    <br/>
                    <a class="fondo" id="borrar" href="./usuario/phpDeleteUser.php">Desactivar Cuenta</a>
                </div>          
            </div>
        </div>
        <?php
        include "./include/footer.php";
        ?>
    </body>
</html>