<?php
require '../require/comun.php';
$error = Leer::get("error");
?>

<!doctype html>
<html lang="es">

    <head>
        <title>Acceso Back-End</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/back-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
    </head>

    <body>
        <div class="vertical-container">	  
            <div id="contenedor">
                <?php include "../include/header.php"; ?>
                <div id="formularioLogin">
                    <a href="../index.php">Inicio Práctica</a>
                    <br/>
                    <br/>
                    <span id="titulo">
                        <img alt="usuario" src="../img/backend.png">
                        Acceso Back-end
                    </span>
                    <form id="form" action="phpLogin.php" method="POST">    
                        <span class="ayuda"><?php echo $error; ?></span>
                        <label for="login">Usuario</label><br/>                    
                        <input type="text" id="login" name="login" value="" required autofocus/>
                        <br/>
                        <br/>
                        <label for="clave">Contraseña</label><br/>                    
                        <input type="password" id="clave" name="clave" value="" required/>
                        <br/>
                        <br/>
                        <input type="submit" id="login" value="Accedder" />                    
                    </form>
                </div>
            </div>
        </div>
        <?php
        include "../include/footer.php";
        ?>
    </body>
</html>
