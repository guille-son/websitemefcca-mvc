<?php

Class ControladorNombrarCarpeta{

    static public function ctrNombrarCarpeta($carpeta){

        $carpeta = preg_replace("/[äáàâãª]/","a",$carpeta);
        $carpeta = preg_replace("/[ÄÁÀÂÃ]/","A",$carpeta);
        $carpeta = preg_replace("/[ÏÍÌÎ]/","I",$carpeta);
        $carpeta = preg_replace("/[ïíìî]/","i",$carpeta);
        $carpeta = preg_replace("/[ëéèê]/","e",$carpeta);
        $carpeta = preg_replace("/[ËÉÈÊ]/","E",$carpeta);
        $carpeta = preg_replace("/[öóòôõº]/","o",$carpeta);
        $carpeta = preg_replace("/[ÖÓÒÔÕ]/","O",$carpeta);
        $carpeta = preg_replace("/[üúùû]/","u",$carpeta);
        $carpeta = preg_replace("/[ÜÚÙÛ]/","U",$carpeta);
        $carpeta = preg_replace("/[çÇ]/","c",$carpeta);
        $carpeta = strtolower(str_replace(" ","_", $carpeta));
        
        return $carpeta;
    }
}