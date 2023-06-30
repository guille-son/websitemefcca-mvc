<?php

Class ControladorBanner{
    /*====================================================
            MOSTRAR BANNER
    =====================================================*/

    static public function ctrMostrarBanner(){
        $tabla = "banner";
        $respuesta = ModeloBanner::mdlMostrarBanner($tabla);

        return $respuesta;
    }
}