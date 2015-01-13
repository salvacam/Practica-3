<?php
require '../require/comun.php';
$login = Leer::get("login");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Bienvenida</title>
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
                        Cuenta Inactiva
                    </span>
                    <span id="">Consulta el email que has introducido para activar la cuenta.</span>
                    <br/>
                    <br/>
                    <a class="fondo" href="phpEnviarAlta.php?login=<?php echo $login; ?>">Reenviar enlace de activación</a>
                </div>
            </div>
        </div>
        <?php
        include "../include/footer.php";
        ?>
    </body>
</html>