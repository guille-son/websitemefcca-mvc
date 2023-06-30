<?php

class Conexion{
    static public function conectar()
    {
        $host="192.168.1.100";
        $dbname="WEBMEFCCA";
        $user="developer";
        $password="H0st1ngm3fc*";

        /* $host="localhost";
        $dbname="WEBMEFCCA";
        $user="root";
        $password="12345678"; */

        $con = new PDO(
            'mysql:host=' . $host . 
            ';dbname=' . $dbname,
            $user,
            $password,
            array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
        );
        return $con;
    }
}
