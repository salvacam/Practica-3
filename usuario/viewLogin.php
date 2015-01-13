<?php
require '../require/comun.php';
$login = Leer::get("login");
$error = Leer::get("error");
?>
<!doctype html>
<html lang="es">

    <head>
        <title>Login</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/front-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
    </head>

    <body>
        <div class="vertical-container">	  
            <div id="contenedor">
                <?php include "../include/header.php"; ?>
                <div id="formulario">
                    <span id="titulo">
                        <img alt="usuario" src="../img/usuario.png">
                        Acceso
                    </span>
                    <form id="form" action="phpLogin.php" method="POST">    
                    <span class="ayuda"><?php echo $error; ?></span>
                        <label for="login">Usuario</label><br/>                    
                        <input type="text" id="login" name="login" value="<?php echo $login;?>" required autofocus/>
                        <br/>
                        <label for="clave">Contraseña</label><br/>                    
                        <input type="password" id="clave" name="clave" value="" required/>
                        <br/>
                        <br/>
                        <input type="submit" id="loginBT" value="Accedder" />                    
                    </form>                    
                    <br/>
                    <a href="viewOlvido.php">¿Has olvidado usuario y/o contraseña?</a>
                    <br/>
                    <br/>
                    <div id="fondoReg">
                        <a href="viewAlta.php" id="registrate">Registrate</a>
                    </div>
                </div>
            </div>
        </div>
        <?php
        include "../include/footer.php";
        ?>
    </body>
</html>