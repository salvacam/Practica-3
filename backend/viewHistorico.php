<?php
require '../require/comun.php';
$sesion->admin("../index.php");
$pagina = 0;
if (Leer::get("pagina") != null) {
    $pagina = Leer::get("pagina");
}
$id = Leer::get("id");
$login = Leer::get("login");
$bd = new BaseDatos();
$modeloLogin = new ModeloLogin($bd);
//$filas = [];
$parametros["login"] = intval($id);
$filas = $modeloLogin->getListBackEnd($pagina, 10, "login=:login", $parametros, "fechaLogin desc");
$total = $modeloLogin->count("login=:login", $parametros);
$enlaces = Util::getEnlacesPaginacion($pagina, $total[0], 10, "viewHistorico.php?id=$id&login=$login");
?>
<!doctype html>
<html lang="es">

    <head>
        <title>Back-End: Login</title>
        <meta charset="utf-8">
        <script src="../js/terceros/sweet-alert.min.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/terceros/sweet-alert.css">
        <link rel="stylesheet" href="../font/font.css">
        <link rel="stylesheet" href="../css/back-end.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
    </head>

    <body>
        <div class="vertical-container">	  
            <div id="contenedor">
                <?php include "../include/header.php"; ?>
                <div id="formulario">					
                    <a class="enlace" href="./index.php"><span id="simbolo">&lt;</span>&nbsp;Volver</a>
                    <span id="titulo">
                        <img alt="usuario" src="../img/backend.png">
                        Historico Login
                    </span>
                    <span class="center nombre">Usuario: <?php echo $login; ?></span>
                    <br/>
                    <table id="tablaBack" class="history">  
                        <tr> 
                            <th>Fecha y Hora</th>                
                            <th>IP</th>
                            <th>Navegador</th>
                        </tr>
                        <?php
                        foreach ($filas as $indice => $objeto) {
                            ?>
                            <tr>
                                <td><?php echo $objeto[0]; //$objeto->getLogin();    ?></td>
                                <td><?php echo $objeto[1]; //$objeto->getNombre();    ?></td>
                                <td><?php echo $objeto[2]; //$objeto->getApellidos();    ?></td>   
                            </tr>
                            <?php
                        }
                        ?>   
                        <tr>
                            <td colspan="3">                    
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
                </div>          
            </div>
        </div>
        <?php
        include "../include/footer.php";
        ?>
    </body>
</html>
