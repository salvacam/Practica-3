<?php

class Login {
    
    //orden de las variables en el orden de la tabla
    private $id;
    private $login;
    private $fechaLogin;
    private $ip;
    private $browser;
    
    //orden igual que las variables, parametros por defecto null
    function __construct($id = null, $login = null, $fechaLogin = null, $ip = null, $browser = null) {
        $this->id = $id;
        $this->login = $login;
        $this->fechaLogin = $fechaLogin;
        $this->ip = $ip;
        $this->browser = $browser;
    }

    //array de datos y posicion inicial
    function set($datos, $inicio = 0) {
        $this->id = $datos[0 + $inicio];
        $this->login = $datos[1 + $inicio];
        $this->fechaLogin = $datos[2 + $inicio];
        $this->ip = $datos[3 + $inicio];
        $this->browser = $datos[4 + $inicio];
    }
    
    function getId() {
        return $this->id;
    }

    function getLogin() {
        return $this->login;
    }

    function getFechaLogin() {
        return $this->fechaLogin;
    }

    function getIp() {
        return $this->ip;
    }

    function getBrowser() {
        return $this->browser;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setLogin($login) {
        $this->login = $login;
    }

    function setFechaLogin($fechaLogin) {
        $this->fechaLogin = $fechaLogin;
    }

    function setIp($ip) {
        $this->ip = $ip;
    }

    function setBrowser($browser) {
        $this->browser = $browser;
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
