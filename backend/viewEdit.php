<?php
require '../require/comun.php';
$sesion->root("../index.php");
$error = Leer::get("error");
$loginpk = Leer::get("login");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);
$nombreUser = $modelo->get($loginpk);
?>
<!DOCTYPE html>
<html> <head>
        <meta charset="UTF-8">
        <title>Editar Usuario</title>        
        <script src="../js/terceros/sweet-alert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/terceros/sweet-alert.css">

        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/back-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <script src="../js/editarBack.js"></script>
    </head>
    <body>
        <div class="vertical-container">	  
            <div id="contenedor">
                <?php include "../include/header.php"; ?>
                <div id="formularioAlta">
                    <a class="enlace" href="./index.php"><span id="simbolo">&lt;</span>&nbsp;Volver</a>
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
                        <img alt="usuario" src="../img/backend.png">
                        Editar usuario
                    </span>
                    <form action="phpEditar.php" id="formAlta" method="POST" enctype="multipart/form-data">           
                        <input type="hidden" name="loginpk" id="loginpk" value="<?php echo $loginpk; ?>"/>
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
                        <label for="isactivo" id="labelActivo">Activo</label>
                        <input class="check" type="checkbox" name="isactivo" id="isactivo" 
                        <?php
                        if ($nombreUser->getIsactivo())
                            echo "checked";
                        ?> />
                        <label for="isroot" id="labelRoot">Root</label>
                        <input class="check" type="checkbox" name="isroot" id="isroot" 
                        <?php
                        if ($nombreUser->getIsroot())
                            echo "checked";
                        ?>/>
                        <br/>
                        <label for="rol1">Rol: Usuario</label>
                        <input type="radio" name="rol" id="rol1" value="usuario" 
                        <?php
                        if ($nombreUser->getRol() == "usuario")
                            echo "checked";
                        ?>/>
                        <br/>
                        <label for="rol2">Rol: Administrador</label>
                        <input type="radio" name="rol" id="rol2" value="administrador"                                
                        <?php
                        if ($nombreUser->getRol() == "administrador")
                            echo "checked";
                        ?>/>
                        <span id="ayudaAdmin">                            
                            <?php
                            if (!$nombreUser->getIsroot())
                                echo "&nbsp;Activa root";
                            ?>
                        </span>
                        <br/>
                        <input type="reset" value="Limpiar" id="limpiar" tabindex="8" />
                        <input type="submit" value="Editar" id="alta" tabindex="7" />
                        <br/>
                        <label for="borrarFoto" id="labelRoot">Borrar Avatar</label>
                        <input class="check" type="checkbox" name="borrarFoto"  id="borrarFoto" />
                        <br/>
                        <label for="archivos">Avatar</label>
                        <input type="file" id="archivos" name="archivos" tabindex="8" />
                        <div id="list"></div>   
                    </form>
                </div>
            </div>
        </div>
        <?php
        include "../include/footer.php";
        ?>
    </body>

</html>