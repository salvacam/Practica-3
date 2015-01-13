<?php

class ModeloLogin {

    //Implementamos los métodos que necesitamos para trabajar con la persona
    private $bd = null;
    private $tabla = "user_login";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function add(Login $objeto) {
        $sql = "insert into $this->tabla values (null, :login, :fechaLogin, :ip, "
                . ":browser);";
        $parametros["login"] = $objeto->getLogin();
        $parametros["fechaLogin"] = $objeto->getFechaLogin();
        $parametros["ip"] = $objeto->getIp();
        $parametros["browser"] = $objeto->getBrowser();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $r; //return 1 si se ha insertado   
    }

    function delete(Login $objeto) {
        $sql = "delete from $this->tabla where id=:id and login=:login and fechaLogin=:fechaLogin;";
        $parametros["id"] = $objeto->getId();
        $parametros["login"] = $objeto->getLogin();
        $parametros["fechaLogin"] = $objeto->getFechaLogin();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function count($condicion = "1=1", $parametros = array()) {
        $sql = "select count(*) from $this->tabla where $condicion";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            //return $this->bd->getFila()[0];
            return $this->bd->getFila();
        }
        return -1;
    }

    function getListBackEnd($pagina = 0, $rpp = Configuracion::RPP, $condicion = "1=1", $parametros = array(), $orderBy = "fechalogin desc") {
        $list = array(); //$list = [];        
        $principio = $pagina * $rpp;
        $sql = "select DATE_FORMAT(`fechalogin`,'%d-%m-%Y / %H:%i,%s'), ip, browser "
                . " from $this->tabla where $condicion order by $orderBy limit $principio, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                //$usuario = new Usuario();
                //$usuario->set($fila, 1);
                $list[] = $fila;
            }
        } else {
            return null;
        }
        return $list;
    }

}
