<?php
require '../require/comun.php';
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Usuario Baneado</title>
        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/front-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
    </head>
    <body>        
        <div class="vertical-container">	  
            <div id="contenedor">
                <?php include "../include/header.php"; ?>
                <div id="formulario">
                    <a href="../index.php">Inicio Práctica</a> 
                    <span id="titulo">
                        <img alt="usuario" src="../img/usuario.png">
                        Usuario Baneado                        
                    </span>
                    <p class="center">Usuario baneado por el administrador</p>
                </div>
            </div>
        </div>
        <?php
        include "../include/footer.php";
        ?>
    </body>
</html>