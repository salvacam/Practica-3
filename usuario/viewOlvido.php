<?php
require '../require/comun.php';
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/front-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <title>Recuperar contraseña o login</title>
        <script src="../js/terceros/sweet-alert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/terceros/sweet-alert.css">
        <script src="../js/olvido.js"></script>
    </head>
    <body>
        <div class="vertical-container">	  
            <div id="contenedor">
                <?php include "../include/header.php"; ?>
                <div id="formulario">
                    <a href="../index.php">Inicio Práctica</a>
                    <span class="ayuda"><?php echo $error; ?></span>
                    <br/>
                    <br/>
                    <span id="titulo">
                        <img alt="usuario" src="../img/usuario.png">
                        Recuperar login
                    </span>
                    <form action="phpOlvido.php" method="POST">     
                        <label for="login">Usuario</label><br/>                  
                        <input type="text" name="login" value="" id="login" autofocus/>                        
                        <br/>
                        o    
                        <br/>
                        <label for="email">Email</label><br/>           
                        <input type="email" name="email" value="" id="email" />
                        <br/>                        
                        <br/>
                        <input type="submit" value="Recuperar" id="enviar" />
                    </form>
                </div>
            </div>
        </div>
        <?php
        include "../include/footer.php";
        ?>
    </body>
</html>