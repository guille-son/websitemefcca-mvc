<?php

class ControladorObtenerIp{
    static public function getRealIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))
            return $_SERVER['HTTP_CLIENT_IP'];
           
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
       
        return $_SERVER['REMOTE_ADDR'];
    }

    static public function finalIP() {
        $ip = ControladorObtenerIp::getRealIP();

        if ($ip == '::1') {
            return gethostbyname(gethostname());
        } else {
            return $ip;
        }
    }
}