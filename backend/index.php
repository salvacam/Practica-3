<?php
require '../require/comun.php';
$sesion->admin("../index.php");
$pagina = 0;
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}
$isroot = $sesion->isRoot();
$nombreUser = $sesion->getAdmin();
$mensaje = Leer::get("mensaje");
$bd = new BaseDatos();
$modelo = new ModeloUsuario($bd);

$filas = $modelo->getListBackEnd($pagina, 7, "isactivo != -10", array(), "fechaalta desc");
$parametros["isactivo"] = "-10";
$total = $modelo->count("isactivo!=:isactivo", $parametros);
$enlaces = Util::getEnlacesPaginacion($pagina, $total[0], 7);
?>
<!doctype html>
<html lang="es">

    <head>
        <title>Back - End</title>
        <meta charset="utf-8">
        <script src="../js/terceros/sweet-alert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/terceros/sweet-alert.css">
        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/back-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <script src="../js/indexBack.js"></script>
    </head>

    <body>
        <div class="vertical-container">	  
            <div id="contenedor">
                <?php include "../include/header.php"; ?>
                <div id="formulario">
                    <span id="titulo">
                        <img alt="usuario" src="../img/backend.png">
                        Back-end
                    </span>
                    <p class="center"><b class="mayuscula"><?php echo $nombreUser->getNombre(); ?></b>
                        estas conectado</p>
                    <a class="fondo" href="./phpLogout.php" id="desconectar">Desconectarse</a>
                    <p class="center"><?php echo $mensaje; ?></p>
                    <table id="tablaBack">  
                        <tr>
                            <th>id</th>  
                            <th>Login</th>  
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Email</th>
                            <th>Fecha Alta</th>                
                            <th>Estado</th>
                            <th>Admin</th>
                            <th>Rol</th>
                            <th>Login</th>
                            <th>Borrar</th>
                            <th>Editar</th>
                        </tr>
                        <?php
                        foreach ($filas as $indice => $objeto) {
                            ?>
                            <tr>
                                <td><?php echo $objeto[0]; //$objeto->getId();       ?></td>
                                <td><?php echo $objeto[1]; //$objeto->getLogin();       ?></td>
                                <td><?php echo $objeto[2]; //$objeto->getNombre();       ?></td>
                                <td><?php echo $objeto[3]; //$objeto->getApellidos();       ?></td>                    
                                <td><?php echo $objeto[4]; //$objeto->getEmail();       ?></td>                    
                                <td><?php echo $objeto[5]; //$objeto->getFechaalta();       ?></td>
                                <td><?php
                                    if ($objeto[6] == 0) {
                                        echo "No activo";
                                    } else if ($objeto[6] == 1) {
                                        echo "Activo";
                                    } else if ($objeto[6] == -1) {
                                        echo "Baneado";
                                    } //$objeto->getIsactivo();  
                                    ?>
                                    &nbsp;
                                    <?php
                                    if ($objeto[6] == 1) {
                                        echo "<a data-login='" . $objeto[1] . "' "
                                        . "class='banear' href='phpBanear.php?login="
                                        . $objeto[1] . "'>Banear</a>";
                                    } else {
                                        echo "<a data-login='" . $objeto[1] . "' "
                                        . "class='activar' href='phpActivar.php?login="
                                        . $objeto[1] . "'>Activar</a>";
                                    }
                                    ?>
                                </td>                    
                                <td><?php
                                    if ($objeto[7] == 0) {
                                        echo "No";
                                    } else {
                                        echo "Si";
                                    }
                                    //echo $objeto[7]; //$objeto->getIsroot();   
                                    ?></td>
                                <td><?php echo $objeto[8]; //$objeto->getRol();       ?></td>                    
                                <td><a href="viewHistorico.php?id=<?php
                                    echo $objeto[0];
                                    ?>&login=<?php
                                       echo $objeto[1];
                                       ?>" 
                                       class="logeos">Ver Login</a></td>
                                <td>
                                    <?php
                                    if ($isroot) {
                                        echo " <a data-login='" . $objeto[1] . "' "
                                        . "class='borrar' href='phpDelete.php?login=" . $objeto[1]
                                        . "&email=" . $objeto[4] . "'>Borrar</a>";
                                    } else {
                                        echo "<span>Necesario root</span>";
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if ($isroot) {
                                        echo " <a class='editar' "
                                        . "href='viewEdit.php?login=" . $objeto[1] . "'>Editar</a>";
                                    } else {
                                        echo "<span>Necesario root</span>";
                                    }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>     
                        <tr>
                            <td colspan="12">                    
                                <?php echo $enlaces["inicio"]; ?>
                                <?php echo $enlaces["anterior"]; ?>
                                <?php echo $enlaces["primero"]; ?>
                                <?php echo $enlaces["segundo"]; ?>
                                <?php echo $enlaces["actual"]; ?>
                                <?php echo $enlaces["cuarto"]; ?>
                                <?php echo $enlaces["quinto"]; ?>
                                <?php echo $enlaces["siguiente"]; ?>
                                <?php echo $enlaces["ultimo"]; ?>
                            </td>
                        </tr>   
                    </table>
                    <br/>                                                          
                    <br/>   
                    <?php
                    if ($isroot) {
                        echo '<a class="fondo" href="./viewAlta.php">Crear Nuevo Usuario</a>';
                    }
                    ?>                                                       
                </div>          
            </div>
        </div>
        <?php
        include "../include/footer.php";
        ?>
    </body>
</html>