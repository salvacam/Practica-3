<?php

class ModeloUsuario {

    //Implementamos los métodos que necesitamos para trabajar con la persona
    private $bd = null;
    private $tabla = "user_usuario";

    function __construct(BaseDatos $bd) {
        $this->bd = $bd;
    }

    function add(Usuario $objeto) {
        $sql = "insert into $this->tabla values (null,:login, :clave, :nombre, "
                . ":apellidos, :email, curdate(), :isactivo, :isroot, :rol );";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = sha1($objeto->getClave());
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        $parametros["isactivo"] = $objeto->getIsactivo();
        $parametros["isroot"] = $objeto->getIsroot();
        $parametros["rol"] = $objeto->getRol();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getAutonumerico(); //return 1 si se ha insertado     
    }

    function alta(Usuario $objeto) {
        $sql = "insert into $this->tabla values (null, :login, :clave, :nombre, "
                . ":apellidos, :email, curdate(), :isactivo, :isroot, :rol);";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = $objeto->getClave();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        $parametros["isactivo"] = 0;
        $parametros["isroot"] = 0;
        $parametros["rol"] = "usuario";
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $r; //return 1 si se ha insertado     
    }

    function delete(Usuario $objeto) {
        $sql = "delete from $this->tabla where login=:login;";
        $parametros["login"] = $objeto->getLogin();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function deletePorLogin($login) {
        return $this->delete(new Usuario($ogin));
    }

    //clave principal autonumérica
    /*  function edit(Persona $objeto) {
      $sql = "update $this->tabla set nombre=:nombre, "
      . "apellidos=:apellidos where id=:id;";
      $parametros["nombre"] = $objeto->getNombre();
      $parametros["apellidos"] = $objeto->getApellidos();
      $parametros["id"] = $objeto->getId();
      $r = $this->bd->setConsulta($sql, $parametros);
      if (!$r) {
      return -1;
      }
      return $this->bd->getNumeroFilas();
      }
     */
    //clave principal no autonumérica
    //function editPK(Usuario $objetoOriginal, Usuario $objetoNuevo) {
    function editPK(Usuario $objeto, $loginpk) {
        $sql = "update $this->tabla set login=:login, clave=:clave, nombre=:nombre, "
                . "apellidos=:apellidos, email=:email, "
                //. "fechalta=:fechaalta "
                . "isactivo=:isactivo, isroot=:isroot, rol=:rol "
                //. "fechalogin=:fechalogin "
                . "where login=:loginpk;";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = sha1($objeto->getClave());
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        //$parametros["fechaalta"] = $objeto->getFechaalta();
        $parametros["isactivo"] = $objeto->getIsactivo();
        $parametros["isroot"] = $objeto->getIsroot();
        $parametros["rol"] = $objeto->getRol();
        //$parametros["fechalogin"] = $objeto->getFechalogin();
        //$parametros["loginpk"] = $objetoOriginal->getLogin();        
        $parametros["loginpk"] = $loginpk;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function editConClave(Usuario $objeto, $loginpk, $claveold) {
        $asignacion = "login=:login, clave=:clave, "
                . "nombre=:nombre, apellidos=:apellidos, "
                . "email=:email";
        $condicion = "login=:loginpk and clave=:claveold";
        $parametros["login"] = $objeto->getLogin();
        $parametros["clave"] = sha1($objeto->getClave());
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        $parametros["loginpk"] = $loginpk;
        $parametros["claveold"] = sha1($claveold);
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function editSinClave(Usuario $objeto, $loginpk, $claveold) {
        $asignacion = "login=:login, "
                . "nombre=:nombre, apellidos=:apellidos, "
                . "email=:email ";
        $condicion = "login=:loginpk and clave=:claveold";
        $parametros["login"] = $objeto->getLogin();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        $parametros["loginpk"] = $loginpk;
        $parametros["claveold"] = sha1($claveold);
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function editSinClaveBack(Usuario $objeto, $loginpk) {
        $asignacion = "nombre=:nombre, apellidos=:apellidos, "
                . "isactivo=:isactivo, isroot=:isroot, rol=:rol ";
        $condicion = "login=:loginpk";
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["isactivo"] = $objeto->getIsactivo();
        $parametros["isroot"] = $objeto->getIsroot();
        $parametros["rol"] = $objeto->getRol();
        $parametros["loginpk"] = $loginpk;
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function editSinClaveBackLogin(Usuario $objeto, $loginpk) {
        $asignacion = "login=:login, nombre=:nombre, apellidos=:apellidos, "
                . "isactivo=:isactivo, isroot=:isroot, rol=:rol ";
        $condicion = "login=:loginpk";
        $parametros["login"] = $objeto->getLogin();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["isactivo"] = $objeto->getIsactivo();
        $parametros["isroot"] = $objeto->getIsroot();
        $parametros["rol"] = $objeto->getRol();
        $parametros["loginpk"] = $loginpk;
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }
    
    function editSinClaveBackEmail(Usuario $objeto, $loginpk) {
        $asignacion = "nombre=:nombre, apellidos=:apellidos, email=:email, "
                . "isactivo=:isactivo, isroot=:isroot, rol=:rol ";
        $condicion = "login=:loginpk";
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        $parametros["isactivo"] = $objeto->getIsactivo();
        $parametros["isroot"] = $objeto->getIsroot();
        $parametros["rol"] = $objeto->getRol();
        $parametros["loginpk"] = $loginpk;
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }
    
    function editSinClaveBackLoginEmail(Usuario $objeto, $loginpk) {
        $asignacion = "login=:login, nombre=:nombre, apellidos=:apellidos, "
                . "email=:email, isactivo=:isactivo, isroot=:isroot, rol=:rol ";
        $condicion = "login=:loginpk";
        $parametros["login"] = $objeto->getLogin();
        $parametros["nombre"] = $objeto->getNombre();
        $parametros["apellidos"] = $objeto->getApellidos();
        $parametros["email"] = $objeto->getEmail();
        $parametros["isactivo"] = $objeto->getIsactivo();
        $parametros["isroot"] = $objeto->getIsroot();
        $parametros["rol"] = $objeto->getRol();
        $parametros["loginpk"] = $loginpk;
        return $this->editConsulta($asignacion, $condicion, $parametros);
    }

    function editConsulta($asignacion, $condicion = "1=1", $parametros = array()) {
        $sql = "update $this->tabla set $asignacion where $condicion;";
        $r = $this->bd->setConsulta($sql, $parametros);        
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function desactivar($loginpk) {
        $sql = "update $this->tabla set isactivo=0 where login=:login;";
        $parametros["login"] = $loginpk;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function banear($loginpk) {
        $sql = "update $this->tabla set isactivo=-1 where login=:login and isactivo=1;";
        $parametros["login"] = $loginpk;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function activar($loginpk) {
        $sql = "update $this->tabla set isactivo=1 where login=:login and (isactivo=-1 or isactivo=0);";
        $parametros["login"] = $loginpk;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
	
	function borrar($loginpk, $email, $num = 0) {
        $sql = "update $this->tabla set login=:login, email=:email, isactivo=:isactivo "
                . "where login=:loginpk and email=:emailpk;";
        $parametros["login"] = "#" . $num . "#" . $loginpk . "#";
        $parametros["email"] = "#" . $num . "#" . $email . "#";
        $parametros["isactivo"] = "-10";
        $parametros["loginpk"] = $loginpk;
        $parametros["emailpk"] = $email;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
/*
    function borrar($loginpk, $email) {
        $sql = "update $this->tabla set login=:login, email=:email, isactivo=:isactivo "
                . "where login=:loginpk and email=:emailpk;";
        $parametros["login"] = "#" . $loginpk . "#";
        $parametros["email"] = "#" . $email . "#";
        $parametros["isactivo"] = "-10";
        $parametros["loginpk"] = $loginpk;
        $parametros["emailpk"] = $email;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }
*/
    function fechalogin(Usuario $objeto) {
        $sql = "update $this->tabla set fechalogin=:fechalogin where login=:login";
        $parametros["fechalogin"] = "now()";
        $parametros["login"] = $objeto->getLogin();
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function activa($id, $login) {
        $sql = "update $this->tabla "
                . "set isactivo = 1 "
                . "where isactivo = 0 and md5(concat(email,'" . Configuracion::PEZARANA . "',login))=:id "
                . "and login=:login;";
        //si quiero poner al usuario desactivado, pongo -1, no 0 si no se podria volver a dar de alta
        $parametros["id"] = $id;
        $parametros["login"] = $login;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    function cambiarClave($login, $id) {
        $sql = "select * from $this->tabla "
                . "where login=:login and md5(concat(login,'" . Configuracion::PEZARANA . "',email))=:id;";
        $parametros["login"] = $login;
        $parametros["id"] = $id;
        $r = $this->bd->setConsulta($sql, $parametros);
        if (!$r) {
            return -1;
        }
        return $this->bd->getNumeroFilas();
    }

    /* function activar($login) {
      $sql = "update $this->tabla set isactivo=1 where isactivo=0 and login=:login;";
      $parametros["login"] = $login;
      $r = $this->bd->setConsulta($sql, $parametros);
      if (!$r) {
      return -1;
      }
      return $this->bd->getNumeroFilas();
      } */

    function login($login, $clave) {
        $sql = "select login from $this->tabla where login=:login and clave=:clave and isactivo=1;";
        $parametros["login"] = $login;
        $parametros["clave"] = sha1($clave);
        $r = $this->bd->setConsulta($sql, $parametros);
        $resultado = $this->bd->getFila();
        $loginEncontrado = $resultado[0];
        if ($login == $loginEncontrado) {
            return $this->get($loginEncontrado);
        }
        return false;
    }

    function loginAdmin($login, $clave) {
        $sql = "select login from $this->tabla where login=:login and "
                . "clave=:clave and isactivo=1 and isroot=1;";
        $parametros["login"] = $login;
        $parametros["clave"] = sha1($clave);
        $r = $this->bd->setConsulta($sql, $parametros);
        $resultado = $this->bd->getFila();
        $loginEncontrado = $resultado[0];
        if ($login == $loginEncontrado) {
            return $this->getAdmin($loginEncontrado);
        }
        return false;
    }

    function loginRoot($login, $clave) {
        $sql = "select login from $this->tabla where login=:login and clave=:clave"
                . " and isactivo=1 and isroot=1 and rol='administrador';";
        $parametros["login"] = $login;
        $parametros["clave"] = sha1($clave);
        $r = $this->bd->setConsulta($sql, $parametros);
        $resultado = $this->bd->getFila();
        $loginEncontrado = $resultado[0];
        if ($login == $loginEncontrado) {
            return $this->getRoot($loginEncontrado);
        }
        return false;
    }

    function isActivo($login, $clave) {
        $sql = "select isactivo from $this->tabla where login=:login and clave=:clave;";
        $parametros["login"] = $login;
        $parametros["clave"] = sha1($clave);
        $r = $this->bd->setConsulta($sql, $parametros);
        $resultado = $this->bd->getFila();
        $isActivoEncontrado = $resultado[0];
        if ($isActivoEncontrado == 0 || $isActivoEncontrado == 1 || $isActivoEncontrado == -1) {
            return $isActivoEncontrado;
        }
        return null;
    }

    //le paso el id y me devuelve el objeto completo
    function get($login) {
        $sql = "select * from $this->tabla where login=:login;";
        $parametros["login"] = $login;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $usuario = new Usuario();
            $usuario->setConId($this->bd->getFila());
            //$usuario->set($this->bd->getFila(), 1);
            return $usuario;
        }
        return null;
    }

    //le paso el id y me devuelve un objeto Admin
    function getAdmin($login) {
        $sql = "select login, clave from $this->tabla where login=:login;";
        $parametros["login"] = $login;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $admin = new Admin();
            $admin->set($this->bd->getFila());
            return $admin;
        }
        return null;
    }

    //le paso el id y me devuelve un objeto Root
    function getRoot($login) {
        $sql = "select login, clave from $this->tabla where login=:login;";
        $parametros["login"] = $login;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $root = new Root();
            $root->set($this->bd->getFila());
            return $root;
        }
        return null;
    }

    //le paso el id y me devuelve el objeto completo
    function getEmail($email) {
        $sql = "select * from $this->tabla where email=:email;";
        $parametros["email"] = $email;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            $usuario = new Usuario();
            $usuario->set($this->bd->getFila());
            return $usuario;
        }
        return null;
    }

    function getId($login) {
        $sql = "select id from $this->tabla where login=:login limit 1;";
        $parametros["login"] = $login;
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            return $this->bd->getFila();
        }
        return null;
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

    function getListBackEnd($pagina = 0, $rpp = Configuracion::RPP, $condicion = "isactivo != -10", $parametros = array(), $orderBy = "id") {
        $list = array(); //$list = [];
        $principio = $pagina * $rpp;
        $sql = "select id, login, nombre, apellidos, email, "
                . "DATE_FORMAT(`fechaalta`,'%d-%m-%Y')"
                . ", isactivo, isroot, rol"
                . " from $this->tabla where $condicion order by $orderBy limit $principio, $rpp";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $list[] = $fila;
            }
        } else {
            return null;
        }
        return $list;
    }

    function getList($condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $list = array(); //$list = [];
        $sql = "select * from $this->tabla where $condicion order by $orderBy";
        $r = $this->bd->setConsulta($sql, $parametros);
        if ($r) {
            while ($fila = $this->bd->getFila()) {
                $usuario = new Usuario();
                $usuario->set($fila, 1);
                $list[] = $usuario;
            }
        } else {
            return null;
        }
        return $list;
    }

    function getListJSON($pagina = 0, $rpp = 3, $condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $pos = $pagina * $rpp;
        $sql = "select * from $this->tabla where $condicion order by $orderBy limit $pos, $rpp";
        $this->bd->setConsulta($sql, $parametros);
        $r = "[";
        while ($fila = $this->bd->getFila()) {
            $usuario = new Usuario();
            $usuario->set($fila);
            $r .= $usuario->getJSON() . ",";
        }
        $r = substr($r, 0, -1) . "]";
        return $r;
    }

    function selectHtml($id, $name, $valorSeleccionado = "", $blanco = TRUE, $textoBlanco = "&nbsp", $condicion = "1=1", $parametros = array(), $orderBy = "1") {
        $select = "<select name='name' id='id'>";
        if ($blanco) {
            $select .= "<option value=''>$textoBlanco</option>";
        }
        //while y añado todos los option que quiera (hacerlo con el getList)
        $lista = $this->getList($condicion, $parametros, $orderBy);
        foreach ($lista as $objeto) {
            $selected = "";
            if ($objeto->getLogin() == $valorSeleccionado) {
                $selected = "selected";
            }
            $select .= "<option $selected value='" . $objeto->getLogin() . "'>"
                    . $objeto->getNombre() . ", " . $objeto->getApellidos()
                    . $objeto->getEmail() . ", " . $objeto->getFechaalta()
                    . $objeto->getIsactivo() . ", " . $objeto->getIsroot()
                    . $objeto->getFechalogin() . "</option>";
        }
        $select .= "</select>";
        return $select;
    }

}
