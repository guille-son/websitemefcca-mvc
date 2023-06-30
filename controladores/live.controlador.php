<?php

Class ControladorLink{
    /*====================================================
            obtenerLink
    =====================================================*/
    static public function ctrObtenerLink(){
        $tabla = "transmisiones_en_vivo";
        $respuesta = ModeloLive::obtenerLink($tabla);

        return $respuesta;
    }
}