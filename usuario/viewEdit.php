<?php
require '../require/comun.php';
$sesion->autentificado("./viewLogin.php");
$nombreUser = $sesion->getUsuario();
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Editar Usuario</title>        
        <script src="../js/terceros/sweet-alert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/terceros/sweet-alert.css">

        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/front-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <script src="../js/editar.js"></script>
    </head>
    <body>
        <div class="vertical-container">	  
            <div id="contenedor">
                <?php include "../include/header.php"; ?>
                <div id="formulario">
                    <a href="../index.php">Inicio Práctica</a> 
                    <?php
                    if ($error == -1) {
                        echo "<span class='ayuda'>Error al editar el usuario</span>";
                    } else if ($error != "") {
                        echo "<span class='ayuda'>$error</span>";
                    }
                    ?>
                    <br/>
                    <br/>       
                    <span id="titulo">
                        <img alt="usuario" src="../img/usuario.png">
                        Editar usuario
                    </span>
                    <form action="phpEditar.php" id="formAlta" method="POST" enctype="multipart/form-data">            
                        <label for="login">Usuario</label>                
                        <input type="text" name="login" 
                               value="<?php echo $nombreUser->getLogin(); ?>" 
                               id="login" tabindex="1" autofocus/><br/>
                        <span id="disponibleLogin" class="ayuda"></span><br/>
                        <label for="email">Email</label>
                        <input type="email" name="email" 
                               value="<?php echo $nombreUser->getEmail(); ?>" 
                               id="email" tabindex="2" required/>                            
                        <span id="disponibleEmail" class="ayuda"></span><br/>
                        <br/>                        
                        <label for="clave">Clave</label>
                        <input type="password" name="clave" value="" id="clave" 
                               placeholder="Clave actual necesaria para editar"
                                tabindex="3"/>  
                        <br/>            
                        <label for="claveNueva">Clave Nueva</label>
                        <input type="password" name="claveNueva" value="" id="claveNueva" tabindex="4"/>          
                        <span id="disponibleClave" class="ayuda"></span><br/>
                        <br/>                        
                        <label for="claveConfirmada">Confirmar clave</label>
                        <input type="password" name="claveConfirmada" value="" id="claveConfirmada" tabindex="5"/>       
                        <span id="disponibleClaveConfirmada" class="ayuda"></span><br/>          
                        <br/>
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" 
                               value="<?php echo $nombreUser->getNombre(); ?>" 
                               id="nombre" tabindex="6" required/>
                        <br/>
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" 
                               value="<?php echo $nombreUser->getApellidos(); ?>" 
                               id="apellidos" tabindex="7" required/>
                        <br/>
                        <label for="borrarFoto" id="labelRoot">Borrar Avatar</label>
                        <input class="check" type="checkbox" name="borrarFoto"  id="borrarFoto" />
                        <br/>
                        <label for="archivos">Avatar</label>
                        <input type="file" id="archivos" name="archivos" tabindex="8" />
                        <div id="list"></div>   
                        <br/>
                        <input type="reset" value="Limpiar" id="limpiar" tabindex="10" />
                        <input type="submit" value="Editar" id="alta" tabindex="9" />
                    </form>
                </div>
            </div>
        </div>
        <?php
        include "../include/footer.php";
        ?>
    </body>

</html>