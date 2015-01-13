<?php
require '../require/comun.php';
$id = Leer::get("id");
$login = Leer::get("login");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$r = $modelo->cambiarClave($login, $id);
if ($r <= 0) {
    $bd->closeConexion();
    header("Location:index.php");
    exit();
}
$bd->closeConexion();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Cambiar Contraseña</title>
        <script src="../js/terceros/sweet-alert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/terceros/sweet-alert.css">

        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/front-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <script src="../js/cambioClave.js"></script>
    </head>
    <body>        
        <div class="vertical-container">	  
            <div id="contenedor">
                <?php include "../include/header.php"; ?>
                <div id="formulario">
                    <a href="../index.php">Inicio Práctica</a> 
                    <br/>
                    <br/>       
                    <span id="titulo">
                        <img alt="usuario" src="../img/usuario.png">
                        Cambiar Contraseña
                    </span>
                    <form action="phpRecupera.php" method="POST" id="formAlta">   
                        <label for="clave">Clave</label>
                        <input type="password" name="clave" value="" id="clave" tabindex="1" autofocus/>             
                        <span id="disponibleClave" class="ayuda"></span><br/>
                        <br/>        
                        <label for="claveConfirmada">Confirmar clave</label>
                        <input type="password" name="claveConfirmada" value="" id="claveConfirmada" tabindex="2" />     
                        <span id="disponibleClaveConfirmada" class="ayuda"></span><br/>          
                        <br/>
                        <input type="hidden" name="id" id="id" value="<?php echo $id; ?>"/>
                        <input type="hidden" name="login" id="login" value="<?php echo $login; ?>"/>
                        <input type="submit" value="Cambiar contraseña" id="alta"/>
                    </form>
                </div>
            </div>
        </div>
        <?php
        include "../include/footer.php";
        ?>
    </body>
</html>