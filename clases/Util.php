<?php

class Util {

    static function getEnlacesPaginacion($pagina, $total, $rpp = Configuracion::RPP, $url = "") { //pagina, los registros que hay, y los que muestra 
        $enlaces = array();
        $paginas = ceil($total / $rpp) - 1;
        if ($pagina < 0) {
            $pagina = 0;
        }
        if ($pagina > $paginas) {
            $pagina = $paginas;
        }
        $inicio = 0;
        $fin = $paginas;
        if (strpos($url, "?") !== false) {
            $url .= "&";
        } else {
            $url .= "?";
        }
        if ($pagina > 0 && $pagina < $paginas - 1) {
            $enlaces["inicio"] = self::getEnlace($inicio, $paginas, $url, '&Lt;');
            $enlaces["anterior"] = self::getEnlace($pagina - 1, $paginas, $url, '&lt;');
            $enlaces["primero"] = self::getEnlace($pagina - 2, $paginas, $url);
            $enlaces["segundo"] = self::getEnlace($pagina - 1, $paginas, $url);
            $enlaces["actual"] = ($pagina + 1);
            $enlaces["cuarto"] = self::getEnlace($pagina + 1, $paginas, $url);
            $enlaces["quinto"] = self::getEnlace($pagina + 2, $paginas, $url);
            $enlaces["siguiente"] = self::getEnlace($pagina + 1, $paginas, $url, '&gt;');
            $enlaces["ultimo"] = self::getEnlace($fin, $paginas, $url, '&Gt;');
        } else if ($pagina == 0) {
            $enlaces["inicio"] = '&Lt;';
            $enlaces["anterior"] = '&lt;';
            $enlaces["primero"] = $pagina + 1;
            $enlaces["segundo"] = self::getEnlace($pagina + 1, $fin, $url);
            $enlaces["actual"] = self::getEnlace($pagina + 2, $fin, $url);
            $enlaces["cuarto"] = self::getEnlace($pagina + 3, $fin, $url);
            $enlaces["quinto"] = self::getEnlace($pagina + 4, $fin, $url);
            $enlaces["siguiente"] = self::getEnlace($pagina + 1, $fin, $url, '&gt;');
            $enlaces["ultimo"] = self::getEnlace($pagina + 1 < $fin ? $fin : $pagina + 1, $fin, $url, '&Gt;');
        } else if ($pagina == 1) {
            $enlaces["inicio"] = self::getEnlace($inicio, $paginas, $url, '&Lt;');
            $enlaces["anterior"] = self::getEnlace($pagina - 1, $paginas, $url, '&lt;');
            $enlaces["primero"] = self::getEnlace($pagina - 1, $paginas, $url);
            $enlaces["segundo"] = ($pagina + 1);
            $enlaces["actual"] = self::getEnlace($pagina + 1, $paginas, $url);
            $enlaces["cuarto"] = self::getEnlace($pagina + 2, $paginas, $url);
            $enlaces["quinto"] = self::getEnlace($pagina + 3, $paginas, $url);
            $enlaces["siguiente"] = self::getEnlace($pagina + 1, $paginas, $url, '&gt;');
            $enlaces["ultimo"] = self::getEnlace($fin, $paginas - 1, $url, '&Gt;');
        } else if ($pagina == $paginas - 1) {
            $enlaces["inicio"] = self::getEnlace($inicio, $paginas, $url, '&Lt;');
            $enlaces["anterior"] = self::getEnlace($pagina - 1, $paginas, $url, '&lt;');
            $enlaces["primero"] = self::getEnlace($pagina - 3, $paginas, $url);
            $enlaces["segundo"] = self::getEnlace($pagina - 2, $paginas, $url);
            $enlaces["actual"] = self::getEnlace($pagina - 1, $paginas, $url);
            $enlaces["cuarto"] = $pagina + 1;
            $enlaces["quinto"] = self::getEnlace($pagina + 1, $paginas, $url);
            $enlaces["siguiente"] = self::getEnlace($pagina + 1, $paginas, $url, '&gt;');
            $enlaces["ultimo"] = self::getEnlace($fin, $paginas, $url, '&Gt;');
        } else if ($pagina == $paginas) {
            $enlaces["inicio"] = self::getEnlace($inicio, $paginas, $url, '&Lt;');
            $enlaces["anterior"] = self::getEnlace($pagina - 1, $paginas, $url, '&lt;');
            $enlaces["primero"] = self::getEnlace($pagina - 4, $paginas, $url);
            $enlaces["segundo"] = self::getEnlace($pagina - 3, $paginas, $url);
            $enlaces["actual"] = self::getEnlace($pagina - 2, $paginas, $url);
            $enlaces["cuarto"] = self::getEnlace($pagina - 1, $paginas, $url);
            $enlaces["quinto"] = $pagina + 1;
            $enlaces["siguiente"] = '&gt;';
            $enlaces["ultimo"] = '&Gt;';
        }
        return $enlaces;
    }

    private static function getEnlace($numero, $paginas, $url, $paginaUsuario = null) {
        if ($numero < 0)
            if ($paginaUsuario == null)
                return "";
            else
                return $paginaUsuario;
        if ($numero > $paginas)
            if ($paginaUsuario == null)
                return "";
            else
                return $paginaUsuario;
        if ($paginaUsuario == null)
            $paginaUsuario = $numero + 1;
        return "<a class='paginacion' href='" . $url . "pagina=$numero'>$paginaUsuario</a>";
    }

}
