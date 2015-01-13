<?php

class Usuario {

    //orden de las variables en el orden de la tabla
    private $id;
    private $login;
    private $clave;
    private $nombre;
    private $apellidos;
    private $email;
    private $fechaalta;
    private $isactivo;
    private $isroot;
    private $rol;

    //orden igual que las variables, parametros por defecto null
    function __construct($login = null, $clave = null, $nombre = null, $apellidos = null, $email = null, $fechaalta = null, $isactivo = 0, $isroot = 0, $rol = 'usuario') {
        $this->id = null;
        $this->login = $login;
        $this->clave = $clave;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->fechaalta = $fechaalta;
        $this->isactivo = $isactivo;
        $this->isroot = $isroot;
        $this->rol = $rol;
    }

    //array de datos y posicion inicial
    function set($datos, $inicio = 0) {
        $this->id = null;
        $this->login = $datos[0 + $inicio];
        $this->clave = $datos[1 + $inicio];
        $this->nombre = $datos[2 + $inicio];
        $this->apellidos = $datos[3 + $inicio];
        $this->email = $datos[4 + $inicio];
        $this->fechaalta = $datos[5 + $inicio];
        $this->isactivo = $datos[6 + $inicio];
        $this->isroot = $datos[7 + $inicio];
        $this->rol = $datos[8 + $inicio];
    }
    
    function setConId($datos, $inicio = 0) {
        $this->id = $datos[0 + $inicio];
        $this->login = $datos[1 + $inicio];
        $this->clave = $datos[2 + $inicio];
        $this->nombre = $datos[3 + $inicio];
        $this->apellidos = $datos[4 + $inicio];
        $this->email = $datos[5 + $inicio];
        $this->fechaalta = $datos[6 + $inicio];
        $this->isactivo = $datos[7 + $inicio];
        $this->isroot = $datos[8 + $inicio];
        $this->rol = $datos[9 + $inicio];
    }

    public function getId() {
        return $this->id;
    }

    public function getLogin() {
        return $this->login;
    }

    public function getClave() {
        return $this->clave;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getFechaalta() {
        return $this->fechaalta;
    }

    public function getIsactivo() {
        return $this->isactivo;
    }

    public function getIsroot() {
        return $this->isroot;
    }

    public function getRol() {
        return $this->rol;
    }

    public function setId($id) {
        $this->id = $id;
    }
        
    public function setLogin($login) {
        $this->login = $login;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellidos($apellidos) {
        $this->apellidos = $apellidos;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setFechaalta($fechaalta) {
        $this->fechaalta = $fechaalta;
    }

    public function setIsactivo($isactivo) {
        $this->isactivo = $isactivo;
    }

    public function setIsroot($isroot) {
        $this->isroot = $isroot;
    }

    public function setRol($rol) {
        $this->rol = $rol;
    }

    public function getJSON() {
        $prop = get_object_vars($this);
        $resp = '{';
        foreach ($prop as $key => $value) {
            $resp .= '"' . $key . '":' . json_encode(htmlspecialchars_decode($value)) . ',';
        }
        $resp = substr($resp, 0, -1) . "}";
        return $resp;
    }

}
