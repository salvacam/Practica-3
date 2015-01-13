<?php
require '../require/comun.php';
$error = Leer::get("error");
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Alta Usuario</title>        
        <script src="../js/terceros/sweet-alert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/terceros/sweet-alert.css">

        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/front-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <script src="../js/alta.js"></script>
    </head>
    <body>
        <div class="vertical-container">	  
            <div id="contenedor">
                <?php include "../include/header.php"; ?>
                <div id="formulario">
                    <a href="../index.php">Inicio Práctica</a> 
                    <?php
                    if ($error == -1) {
                        echo "<span class='ayuda'>Error al crear el usuario</span>";
                    } else if($error != ""){                        
                        echo "<span class='ayuda'>$error</span>";
                    }
                    ?>
                    <br/>
                    <br/>       
                    <span id="titulo">
                        <img alt="usuario" src="../img/usuario.png">
                        Crear usuario
                    </span>
                    <form action="phpAlta.php" id="formAlta" method="POST" enctype="multipart/form-data">            
                        <label for="login">Usuario</label>                
                        <input type="text" name="login" value="" id="login" tabindex="1" autofocus/><br/>
                        <span id="disponibleLogin" class="ayuda"></span><br/>
                        <label for="email">Email</label>
                        <input type="email" name="email" value="" id="email" tabindex="2" required/>                            
                        <span id="disponibleEmail" class="ayuda"></span><br/>
                        <br/>
                        <label for="clave">Clave</label>
                        <input type="password" name="clave" value="" id="clave" tabindex="3"/>          
                        <span id="disponibleClave" class="ayuda"></span><br/>
                        <br/>
                        <label for="claveConfirmada">Confirmar clave</label>
                        <input type="password" name="claveConfirmada" value="" id="claveConfirmada" tabindex="4"/>       
                        <span id="disponibleClaveConfirmada" class="ayuda"></span><br/>          
                        <br/>
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" value="" id="nombre" tabindex="5" required/>
                        <br/>
                        <label for="apellidos">Apellidos</label>
                        <input type="text" name="apellidos" value="" id="apellidos" tabindex="6" required/>
                        <!--comprobar por javascript los valores, que la clave coincida-->
                        <br/>
                        <label for="archivos">Avatar</label>
                        <input type="file" id="archivos" name="archivos" tabindex="7" />
                        <div id="list"></div>
                        <br/>
                        <input type="reset" value="Limpiar" id="limpiar" tabindex="9" />
                        <input type="submit" value="Alta" id="alta" tabindex="8" />
                    </form>
                </div>
            </div>
        </div>
        <?php
        include "../include/footer.php";
        ?>
    </body>

</html>