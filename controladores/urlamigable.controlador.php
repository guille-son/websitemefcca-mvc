<?php

Class ControladorUrlAmigable{

    static public function ctrUrlAmigable($url){

        $url = preg_replace("/[äáàâãª]/","a",$url);
        $url = preg_replace("/[ÄÁÀÂÃ]/","A",$url);
        $url = preg_replace("/[ÏÍÌÎ]/","I",$url);
        $url = preg_replace("/[ïíìî]/","i",$url);
        $url = preg_replace("/[ëéèê]/","e",$url);
        $url = preg_replace("/[ËÉÈÊ]/","E",$url);
        $url = preg_replace("/[öóòôõº]/","o",$url);
        $url = preg_replace("/[ÖÓÒÔÕ]/","O",$url);
        $url = preg_replace("/[üúùû]/","u",$url);
        $url = preg_replace("/[ÜÚÙÛ]/","U",$url);
        $url = preg_replace("/[çÇ]/","c",$url);
        $url = preg_replace("/[ñÑ]/","n",$url);
        $url = preg_replace("[()¿?!¡/_´'&,:-=+#.;%@]","",$url);
        $url = str_replace('"',"",$url);
        $url = str_replace('”',"",$url);
        $url = str_replace('[',"",$url);
        $url = str_replace(']',"",$url);
        $url = str_replace("\\","",$url);
        //condición para que las palabras de 3 o menos caracteres no aparezcan en la url y las sustituimos por espacios
        $url = preg_replace('/\b.{1,3}\b/', ' ', $url);
        //eliminanos los espacios de la anterior sustitución
        $url = preg_replace('/\s\s+/', '-', $url);
        //eliminamos los espacios al principio y final
        $url = trim($url);
        $url = strtolower(str_replace(" ","-", $url));
        return $url;
    }
}